<?php

namespace App\Http\Controllers;

use App\Helper\GlobalHelper;
use App\Models\DaycareProvider;
use App\Models\Parents;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\TicketReason;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use NunoMaduro\Collision\Provider;

class CommunicationController extends Controller
{

    public function createTicket()
    {
        $authUser = User::find(Auth::id());
        $baseReasons = TicketReason::where('status', 1);
        if ($authUser->hasRole('Franchise')) {
            $baseReasons->where('name', '!=', 'Daycare');
        }
        $reasons = $baseReasons->get();
        $dropdownOptions = [];
        $authUser = User::find(Auth::id());

        $admins = User::whereHas('roles', function ($query) {
            $query->where('name', 'Admin');
        })->get();

        if (isset($authUser) && $authUser->hasRole('Admin')) {
            $providers = DaycareProvider::all();
            $parents = Parents::all();
            $dropdownOptions['Providers'] = $providers;
            $dropdownOptions['Parents'] = $parents;
        } elseif (isset($authUser) && $authUser->hasRole('Franchise')) {
            $parents = Parents::where('daycare_provider_id', $authUser->provider->id)->get();
            $dropdownOptions['Parents'] = $parents;
            $dropdownOptions['High5 Admin'] = $admins;
        } else {
            $provider = DaycareProvider::where('id', $authUser->parent->provider->id)->first();
            $dropdownOptions['High5 Admin'] = $admins;
            $dropdownOptions['Provider'] = [$provider];
        }

        return view('create-ticket', compact('reasons', 'dropdownOptions'));
    }

    public function messageIndex(Request $request)
    {
        $user = User::find(Auth::id());

        $ticketsQuery  = $user->tickets()->with(['messages', 'sender', 'receiver', 'lastMessage', 'reason'])->latest('updated_at');

        if($user->hasRole('Admin'))
        {
          $ticketsQuery  = Ticket::with(['messages', 'sender', 'receiver', 'lastMessage', 'reason'])->latest('updated_at');
        }
        // Get the search query from the request
        $searchQuery = $request->input('search_query');

        // If a search query is provided, filter the tickets
        if (!empty($searchQuery)) {
            $ticketsQuery->where(function ($query) use ($searchQuery) {
                $query->where('tickets.ticket_id', 'like', '%' . $searchQuery . '%')
                    ->orWhere('subject', 'like', '%' . $searchQuery . '%');
            });
        }

        $tickets = $ticketsQuery->latest()->paginate(10);

        foreach ($tickets as $ticket) {
            $unreadCount = $ticket->messages->where('receiver_id', Auth::id())->where('read_at', null)->count();
            $ticket->unread_count = $unreadCount;
        }

        return view('communication', compact('tickets'));
    }


    public function messageShow(Ticket $ticket)
    {
        $ticket->load('messages.sender', 'messages.receiver', 'sender', 'receiver', 'reason');
        $messages = $ticket->messages()->orderBy('created_at', 'asc')->get();

        if (isset($messages) && !empty($messages) && count($messages) > 0) {
            $ticket->messages()->where('receiver_id', Auth::id())->update(['read_at' => now()]);
        }

        return view('communication-detail', compact('ticket', 'messages'));
    }


    public function storeMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
        ]);

        $user = User::find(Auth::id());

        // $open_conversations = $user->tickets()->where('status', 'open')->where('receiver_id', $request->receiver_id)->count();
        // if($open_conversations > 0) {
        //     return redirect()->back()->with('error','You cannot create a new conversation while you have open conversations.');
        // }

        $receiver = User::findOrFail($request->receiver_id);

        // Check if a conversation already exists between the two users
        $ticket = Ticket::where(function ($query) use ($receiver) {
            $query->where('sender_id', auth()->user()->id)
                ->where('receiver_id', $receiver->id)->where('status', 'open');
        })->orWhere(function ($query) use ($receiver) {
            $query->where('sender_id', $receiver->id)
                ->where('receiver_id', auth()->user()->id)->where('status', 'open');
        })->first();

        if (!$ticket) {
            // Create a new conversation
            $ticket = Ticket::create([
                'sender_id' => auth()->user()->id,
                'receiver_id' => $receiver->id,
                'subject' => $request->subject,
                'description' => $request->description,
                'reason_id' => $request->reason_id,
                'ticket_id' => GlobalHelper::generateTicketNumber(),
            ]);
            $ticket->users()->attach([$ticket->sender_id, $ticket->receiver_id]);
        }

        // Create a new message
        $message = TicketMessage::create([
            'ticket_id' => $ticket->id,
            'sender_id' => auth()->user()->id,
            'receiver_id' => $receiver->id,
            'message' => $request->message,
        ]);

        if (!empty($request->attachment)) {
            $filesUploaded = $request->file('attachment');
            $uploadedFiles = GlobalHelper::uploadAndSaveFile($filesUploaded, 'uploads/chat/attachments');

            foreach ($uploadedFiles as $filePath) {
                $filesToAssociate[] = ['path' => $filePath];
            }
            $message->media()->createMany($filesToAssociate);
        }

        return redirect()->back()->with('success', 'Message send successfully');
    }


    public function initializeChat(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'description' => 'required',
            'reason_id' => 'required',
        ]);

        $user = User::find(Auth::user()->id);

        $open_conversations = $user->tickets()->where('status', 'open')->where('receiver_id', $request->receiver_id)->count();

        if ($open_conversations > 0) {
            return redirect()->back()->with('error', 'You cannot create a new ticket while you have open ticket with the same person.');
        }

        $receiver = User::findOrFail($request->receiver_id);

        // Check if a ticket already exists between the two users
        $ticket = Ticket::where(function ($query) use ($receiver) {
            $query->where('sender_id', auth()->user()->id)
                ->where('receiver_id', $receiver->id)->where('status', 'open');
        })->orWhere(function ($query) use ($receiver) {
            $query->where('sender_id', $receiver->id)
                ->where('receiver_id', auth()->user()->id)->where('status', 'open');
        })->first();

        if (!$ticket) {
            // Create a new conversation
            $ticket = Ticket::create([
                'sender_id' => auth()->user()->id,
                'receiver_id' => $receiver->id,
                'subject' => $request->subject,
                'description' => $request->description,
                'reason_id' => $request->reason_id,
                'ticket_id' => GlobalHelper::generateTicketNumber(),
            ]);
            $ticket->users()->attach([$ticket->sender_id, $ticket->receiver_id]);
        }

        if (!empty($request->attachment)) {

            $message = TicketMessage::create([
                'ticket_id' => $ticket->id,
                'sender_id' => auth()->user()->id,
                'receiver_id' => $receiver->id,
                'message' => ' ',
            ]);

            $filesUploaded = $request->file('attachment');
            $uploadedFiles = GlobalHelper::uploadAndSaveFile($filesUploaded, 'uploads/chat/attachments');

            foreach ($uploadedFiles as $filePath) {
                $filesToAssociate[] = ['path' => $filePath];
            }

            $message->media()->createMany($filesToAssociate);
        }

        return redirect()->route('communication')->with('success', 'Ticket created successfully');
    }


    public function endCommunication(Ticket $ticket,Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|between:1,5',
            'feedback' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find(Auth::id());

        if ($user->id == $ticket->sender_id) {
            $ticket->update([
                'sender_rating' => $request->input('rating'),
                'sender_feedback' => $request->input('feedback'),
            ]);
        }

        if ($user->id == $ticket->receiver_id) {
            $ticket->update([
                'receiver_rating' => $request->input('rating'),
                'receiver_feedback' => $request->input('feedback'),
            ]);
        }

        $ticket->update(['status' => 'closed']);
        return redirect()->route('communication')->with('success', 'Ticket ended successfully');
    }


    public function updateFeedback(Request $request, $ticketId)
    {
        $ticket = Ticket::find($ticketId);

        // Validate the request data as needed
        $user = User::find(Auth::id());

        if ($user->id == $ticket->sender_id) {
            $ticket->update([
                'sender_rating' => $request->input('sender_rating'),
                'sender_feedback' => $request->input('sender_feedback'),
            ]);
        }

        if ($user->id == $ticket->receiver_id) {
            $ticket->update([
                'receiver_rating' => $request->input('receiver_rating'),
                'receiver_feedback' => $request->input('receiver_feedback'),
            ]);
        }

        return redirect()->route('tickets.show', $ticket->id)->with('success', 'Feedback submitted successfully.');
    }
}
