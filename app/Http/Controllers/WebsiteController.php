<?php

namespace App\Http\Controllers;

use App\Helper\GlobalHelper;
use App\Models\Blog;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('website.index');
    }
    public function aboutPage()
    {
        return view('website.about');
    }
    public function providersPage()
    {
        return view('website.providers');
    }
    public function parentsPage()
    {
        return view('website.parents');
    }

    public function blogsPage(Request $request)
    {
        $baseQuery = Blog::query();
        $searchText = $request->input('search_text');

        if (!empty($searchText)) {
            $baseQuery->where('title', 'LIKE', "%$searchText%");
        }

        $blogs = $baseQuery->where('status', 1)->paginate(6);

        return view('website.blogs', compact('blogs', 'searchText'));
    }

    public function blogSingle($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        $latest = Blog::where('status', 1)->latest()->limit(3)->get();
        return view('website.blog_single', compact('blog', 'latest'));
    }

    public function blogsIndex(Request $request)
    {
        $baseQuery = Blog::query();
        $searchText = $request->input('search_query');

        if (!empty($searchText)) {
            $baseQuery->where('title', 'LIKE', "%$searchText%");
        }

        $blogs = $baseQuery->orderBy('created_at', 'desc')->paginate(10);
        // $blogs = Blog::orderBy('created_at', 'desc')->paginate(10);
        return view('blogs', compact('blogs', 'searchText'));
    }

    public function createBlog()
    {

        return view('create-blog');
    }
    public function editBlog($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        return view('create-blog', compact('blog'));
    }

    public function blogStore(Request $request, $id = null)
    {
        $rules = [
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
        // If updating, add unique rule for the title
        if ($id) {
            $rules['title'] = 'required|unique:blogs,title,' . $id;
        }
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $blog = $id ? Blog::findOrFail($id) : new Blog();

        $uploadedFiles = [];
        $image = '';

        if ($request->hasFile('image')) {
            $uploadedFiles['image'] = $request->file('image');
            $uploadedFiles = GlobalHelper::uploadAndSaveFile($uploadedFiles, 'blog_images');

            $image = $uploadedFiles['image'] ?? null;
        } elseif (!empty($id)) {
            $image = $blog->image;
        }
        $blog->image = $image;
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->save();

        return redirect()->route('all.blogs')->with('success', 'Blog created successfully');
    }

    public function updateStatus(Request $request)
    {
        $blogId = $request->input('blogId');
        $status = $request->input('status');

        // Update the blog status in the database
        $blog = Blog::findOrFail($blogId);
        $blog->status = $status;
        $blog->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }

    public function contactForm(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'message' => 'required|string',
            'type' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = Contact::create($request->all());

        $data = [
            'data' => $data,
        ];

        GlobalHelper::sendEmail('info@high5daycare.ca', "A new contact message has been recieved", 'emails.contact', $data);
        return redirect()->route('website')->with('success', 'Contact message submitted successfully');
    }
}
