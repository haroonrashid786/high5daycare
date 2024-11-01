@extends('layouts.app')
@section('title', 'Parent Guide | High5 Daycare')
@section('content')

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar d-flex pb-3 pb-lg-5">
            <!--begin::Toolbar container-->
            <div class="d-flex flex-stack flex-row-fluid">
                <!--begin::Toolbar container-->
                <div class="d-flex flex-column flex-row-fluid">
                    <!--begin::Toolbar wrapper-->
                    <!--begin::Page title-->
                    <div class="page-title d-flex align-items-center me-3">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex flex-column justify-content-center text-white fw-bold fs-lg-3x gap-2">
                            <span>Parent Guide</span>
                        </h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Page title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold mb-3 fs-7">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-[#fff] fw-bold lh-1">
                            <a @role('Admin') href="{{ route('admin.home') }}" @elserole('Franchise') href="{{ route('provider.home') }}" @else href="{{ route('parent.home') }}" @endrole class="text-white text-hover-primary">
                                <img src="{{asset('assets/media/Home.svg')}}" class="" alt="" />
                            </a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <i class="ki-outline ki-right fs-7 text-[#fff] mx-n1"></i>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-white">Parent Guide</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Toolbar container-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-5 mb-xl-0">
                <!--begin::Col-->
                <div class="col-md-12 mb-xl-10">
                    <!--begin::Card widget 28-->
                    <div class="card card-flush">
                        <!--begin::Header-->

                        <!--end::Card title-->
                        <!--begin::Card body-->
                        <div class="card-body align-items-end">
                            <!--begin::Wrapper-->
                            <form class="form" method="POST" id="kt_modal_add_event_form" action="{{ route('add.parent.contract',['parent' => $parent->id ]) }}">
                                @csrf
                                <!--begin::Modal header-->
                                <!--begin::Modal title-->
                                <h2 class="fw-bold" data-kt-calendar="title">Welcome to High Five Child Care Agency</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->

                                <!--end::Close-->
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="py-5 px-lg-10">

                                    <div class="mb-12">

                                        <h1 class="text-center">CONTRACT POLICY</h1>

                                        <div class="rounded p-4 border mb-6">
                                            <h5>INTRODUCTION</h5>
                                            <p>High Five Child Care Agency based in Ontario functions under the Ministry of Education and is striving to offer child care in the best promising environment suitable to families, parents and their children through a flexible Program Statement.</p>

                                            <p>High Five Child Care agency licensed under The Child Care and Early Years Act, 2014 (CCEYA) provides best possible child care environment to promote child wellbeing and development during its early years of life. </p>

                                            <p>High Five Child Care agency is currently in the process of enrollment to Canada Wide Early Learning & Child Care program and is enrolled only in Halton region.</p>

                                            <p>High Five Child Care Agency licensed for _____ homes in the community. Parents / guardians are encouraged to visit any of the High Five Child Care home during program hours to have first-hand information about the standard of quality care and education being imparted by the Agency.</p>


                                            <h5>For more detailed information about our services, parents / guardian may contact any of the following:</h5>

                                            <h5>Home Visitors:</h5>
                                            <h5>Following Home Visitors are responsible for overseeing High Five Child Care Agency’s licensed home child care:</h5>





                                            <h5>Services Manager:</h5>



                                            <h5>Assistant Director:</h5>
                                            <p> </p>







                                            <h5>Program Offered:</h5>
                                            <p>The programs offered by High Five Child Care Agency include early learning and care child care programs, before and after school programs and overseeing licensed home early learning and child care programs.</p>

                                            <p>The programs are intended for infant, toddler/ preschooler and school aged children. </p>

                                            <h5>Working Hours:</h5>
                                            <p>Services are available for the working hours and days as per requirement of the parent. Parent requiring for extra hours after enrolment must request so through two weeks’ notice. Overtime fees will be charged in case the parent requires extra hours. </p>

                                            <h5>Legal Holidays:</h5>
                                            <p>There are 9 legal holidays each year; New Year Day, Family Day, Good Friday, Victoria Day, Canada Day, Labor Day, Thanksgiving, Christmas and Boxing Day. However, Easter Monday and the Civic Holiday are not legal holidays.</p>
                                            <p>Besides, there will be additional Holidays for Eid-ul-Fitr, Eid-ul-Azha and Diwali (respectively).</p>
                                            <p>Non-Base Fees: </p>
                                            <p>Overtime charges: Our official timings are 7am – 6pm . If parents are required to start earlier than 7:00am and later than 6:00pm then they will pay overtime. It will be $10 per hour</p>
                                            <p>Also, if parents are looking to get a service on weekends, then there will be additional $10 per day </p>
                                            <h5>Base Fee :</h5>
                                            <p>Registration Fees: $45</p>
                                            <p>Deposit (2 weeks) : Full Program fees</p>
                                            <p>Charges are subject to change based on child’s age, hours, transportation requirements, etc.</p>
                                            <h5>Standard charges are as follows:</h5>
                                            <p>Full day: younger than 2 years old (not to exceed 10 hours)$49.84. </p>
                                            <p>Full day: 2-3 years (not to exceed 10 hours) 47.69 </p>
                                            <p>Full day: 4-6 years (not to exceed 10 hours) $47.20 </p>
                                            <p>Before & after school: 4-5 years $33.86 </p>
                                            <p>Before & after school: 6-12 years $36.48 </p>


                                            <p>Pick up and Drop</p>
                                            <p>In order to safeguard the safety of child, High Five Child Care Agency at the time of enrollment of the child requires a written permission from the parents about the person who will pick up the child. Such person has to prove his identity before picking up the child. Parents are required to update the Agency in writing about any changes or alternative pick-up arrangements.</p>

                                            <h5>Admission Policy:</h5>
                                            <p>The prospective parents intend to use the services of High Five Child Care Agency have to fill and submit an application form mentioning therein the requisite details necessary for maintaining record of each child. Upon scrutiny of the form and enrolment papers, a meeting is held between the provider and the parents and the child. The family is encouraged to have a look at the premises and the facilities available therein. </p>

                                            <p>In case the services of the Agency do not meet the needs of the family or the child, the Agency will provide assistance in finding an alternative solution suitable to the family or the child. </p>

                                            <p>Once, spot is confirmed by the parents , they are required to pay 2 weeks in advance fees in order to confirm the spot . </p>

                                            <h5>Wait List Policy:</h5>
                                            <p>Since High Five Day Care Agency strictly adheres to the rule of allowing a certain number of children in a child care center or home child care program under the Child Care and Early Years Act, therefore, priority is given siblings of children already enrolled. Children will be prioritized based on availability and the chronology in which the child was placed on the waiting list. The child is placed on a wait list for admission till space becomes available within program. The wait list is specific to the program location and does not guarantee placement of every child on the wait list. On availability of space, Agency’s program supervisor or placement consultant contacts parents.</p>


                                            <p>High Five Child Care Agency does not charge parents deposit for the placement of their child on a waiting list for a spot in a home premises that the Agency oversees. An enrolment fee is charged once a child has been offered a spot in a home child care premises.</p>

                                            <p>Confidentiality </p>
                                            <p>The waiting list will be maintained in a manner that protects the privacy and confidentiality of the children and families on the list and therefore, only the child's position on the waiting list will be provided to parents upon request. Names of other children and/or families and/or their placement will not be shared with other individuals.</p>

                                            <p>Procedure</p>
                                            <p>When a space becomes available, the family at the top of the waitlist will be contacted. Once a placement is offered, the parents will be charged the registration fee. Parents are required to confirm their acceptance of the offered placement with 48 hours. If they do not accept the placement within given time, the next family on the waitlist will be contacted. Siblings of children currently enrolled are given priority for placement on waiting list, however, parents have to fill the waiting list request form.</p>

                                            <p>Withdrawal / Discharge Policy</p>
                                            <p>A two weeks written notice is required from the parents who wish to withdraw their child from the program. In case of non-receipt of the notice, full program fees will be charge, which we collect at the time of registeration.</p>

                                            <p>If a child withdrawn for a temporary period or parents wishes to get their child re-admitted, such child will be placed on the waiting list and will be admitted on availability of space.</p>

                                            <p>Activities Off the Premises</p>
                                            <p>High Five Child Care Agency strongly encouraged community outings as part of the program philosophy. In case of off the premises activities, parents will be notified in advance about the date, time and place of the destination and parents are required to sign a permission form.</p>

                                            <p>Participation by Parents and Family</p>
                                            <p>High Five Child Care Agency actively encourages parent and family to participate on our program as volunteers. They are always invited to take part in the program by sharing a talent or skills, sharing cultural experiences, provide feedback on the services offered and participate on our advisory committee meetings.</p>

                                            <p>Inclement Weather Policy</p>
                                            <p>Although every effort is made by High Five Child Care Agency to provide child care services throughout the year, however, in the event of inclement / extreme weather, dangerous road conditions, etc, we may close early or not open. In such situation, Agency’s representative or the provider, as the case may be, will try to contact the parents for providing update.</p>

                                            <p>Nutrition Policy </p>
                                            <p>Proper health, growth, development and well-being of children largely depends upon proper and adequate nutrition at the early years. At High Five Child Care Agency, children are served with balance diet at the schedule timings meeting their daily requirement of energy / calories. Exhaustive menu is prepared by the provider in consultation with the parents so that permissible variety of healthy food is available to the children at the scheduled timing.</p>

                                            <p>Extra energy is required by the children attending full day child care to keep them active throughout the day. This need can only be met by a healthy and balanced food containing all the necessary requirement of vitamin, fats, etc.</p>

                                            <p>The home visitors examine the food and the daily menu chart which is given by the provider under the Canada’s Nutrition Guide and help provider to make sure that the children are having variation of food from each food group through their daily based menu. The process of food preparation is in consideration.</p>


                                            <h5>Food Policy :</h5>
                                            <p>The parents can provide the food or snacks to their child if the provider could not fulfill the child’s need, but it should be properly labelled with child’s full name, date and should not be shared or exchanged with any child under the proper surveillance.</p>
                                            <p>Also, do not bring food to the childcare premises that contains allergic ingredients </p>

                                            <p>Menus</p>
                                            <p>High Five Child Care agency’s home child care provider are required to prepare a daily / weekly Menu or for the period / duration suitable to the provider showing meals and snacks given to the children at home. Parent’s suggestions / recommendations are noted and included in the menu along with substitute foods in case the listed food is not readily available any time / day. </p>
                                            <p>Special Feeding Arrangements</p>
                                            <p>At High Five Child Care center and home, alternative food for the children with special dietary is made available with the assistance of the parents e.g. children with known milk allergy are provided with an alternative food. While alterations are made in the menu, it is ensured that dietary need of the other children as well as that of with known food allergy is not compromised. In case a child has dietary restriction or requirements, written instructions or Individualized Support Plan form is obtained from the parents.</p>
                                            <p>In order to avoid cross contamination, it must be ensured that a child with a life threatening allergy / anaphylaxis use only his / her dishes and cutlery so that allergen present on other children’s dishes / cutlery may not come in contact with the allergy sensitive child. </p>
                                            <p>Health Policy</p>
                                            <p>The child care providers of High Five Day Care Agency are required to maintain the updated health and boosters/vaccines record sheet of all registered children which is provided by the agency so that it can be accessible on demand.</p>
                                            <p>Smoking Prohibition</p>
                                            <p>Under the Smoke Free Ontario Act 2006, smoking is strictly prohibited in all day nurseries and private home daycare, licensed under the Day Nurseries Act. Thus, High Five Child Care Agency has made it obligatory to all licensed child care home to be smoke free irrespective of the presence of children. </p>

                                            <p>Maintenance Of Hygiene </p>
                                            <p>At High Five Child Care Agency special attention is given on maintenance of hygienic conditions which reduces the children exposure to the illness cause by germs. Since germs present on toys and other frequently used surfaced can live for hours to weeks, therefore, spread of germs is minimized by way of first cleaning with soap and water and then disinfecting. </p>

                                            <p>First Aid </p>
                                            <p>Children are susceptible to injuries despite taking precautions. Child care home staff should be prepared to deal with any untoward situation / emergency. High Five Child Care Agency strongly recommend the providers to get their staff trained from a recognized institute / hospital so that they are prepared to deal with any untoward situation / emergency and able to give first aid and take appropriate and prompt action in case of serious incidents like poising, choking and administer CPR, if required.</p>

                                            <p>Drug And Medication Administration Policy and Procedure</p>
                                            <p>In order to provide explicit instructions to child care home provider, staff, students and volunteer regarding administering drugs or medication to the children at home child care premises, High Five Child Care agency has developed Drug and Medication Administration Policy and Procedure. </p>
                                            <p>This policy is made as per mandatory requirement vide Ontario Regulation 37/15 for the administration of drugs and medication in home child care premises overseen by home child care agencies.</p>

                                            <h5>The aims of the policy and procedures i.e. children’s health, safety and well-being can be achieved by ensuring that:</h5>

                                            <p>Only those drugs or medication is administered to the children deemed necessary and appropriate by their parents;</p>
                                            <p>The potential for errors is reduced,</p>
                                            <p>Medication do not spoil due to improper storage.</p>
                                            <p>Accidental ingestion is prevented</p>
                                            <p>Emergency allergy and asthma drugs or medication are administered promptly when needed, and</p>
                                            <p>Drugs and medications are administered safely according to established routine.</p>

                                            <p>Rest Period</p>
                                            <p>At High Five Child Care Agency it firmly believed that there should be a balanced day for a child between his indoor and out door’s energetic amusement and relaxing hobbies. Relaxing hobbies will help their body to re-energize. During the infant, toddler and preschool level, relaxing hobbies must contain nap time. Activities like listening music, reading favorite books, or participating in any other restful activity can be done by School age children as relaxing hobbies.</p>

                                            <p>Nap / Sleep Time</p>

                                            <p>At High Five Child Care Agency center and child care home providers, nap / sleep schedule of a child is generated with the assistance of child’s parent / guardian and the nap/sleep time/area is assessed together with them, so that they can evaluate their child’s nap/sleep patterns and the changes or concerns made (if any). </p>

                                            <p>Maintaining A Journal For Child’s Nap/Sleep Time </p>
                                            <h5>All the High Five Child Care Agency’s provider are required to maintain a ‘Nap/Sleep Journal’ of each child on daily basis by adding information regarding:</h5>
                                            <p>Pattern and/or reoccurrence of nap(s)</p>
                                            <p>Caliber of nap(s)</p>
                                            <p>Duration of nap(s)</p>
                                            <p>Times of inspections done when the child(ren) were sleeping</p>
                                            <p>Any noticed changes or concerns regarding sleep or nap pattern (and should be informed to parent/guardian about the details)</p>

                                            <p>Parents/guardian can also ask for their child’s nap/sleep time log.</p>

                                            <p>Toileting</p>
                                            <p>For the children who are not yet toilet trained, parents are required to supply diapers and bring in extra cloth to support toilet readiness.</p>

                                            <p>Behaviour Management Policy</p>
                                            <p>High Five Child Care Agency has developed Behavior Management Policy so that requirements under the Child Care and Yearly Years Act 2014 are materialized by the home child care providers in the best possible ways. </p>
                                            <p>One of the main priority of High Five Child Care agency is the emotional and physical well-being of the children in care. An ideal policy yields results only when it is acted upon by all the stakeholders which in this case are the agency, the provider, the parents and the children. It is desired that the children at child care home display good manner and etiquette must know how to interaction with others keeping self-regulation, self-confidence and sensitivity.</p>
                                            <p>Prohibited Practices</p>
                                            <h5>Following practices are not permitted at High Five Child Care as per Ontario’s the Child Care and Early Years Act, 2014:</h5>
                                            <p>a) Corporal punishment including but not limited to hitting, spanking, slapping, pinching of the child</p>
                                            <p>b) Physical restraining of the child for the purpose of punishment or discipline such as confounding the child to a chair, stroller or other devices. It is permitted only in exceptional cases as a last resort for the purpose of preventing a child from hurting himself / herself, subject to the condition that the risk of imminent injury is minimized. </p>
                                            <p>c) Confining or locking the child in the home child care premises without adult supervision, except during a state of emergency or serious occurrence</p>
                                            <p>d) Using derogatory language with the child or in his presence, shouting, threatening or other degrading measures that would frighten the damage child confidence, self-respect. </p>
                                            <p>e) Depriving the child of basic needs like food, drink, sleep, toilet use, bedding, etc.</p>
                                            <p>f) Imposition of one’s will, personal liking / disliking upon the children. </p>
                                            <p>g) Inflicting any bodily harm on children including making children eat or drink against their will</p>


                                            <p>Prompt Reporting Of Serious Occurrences</p>
                                            <p>Under the Family and Social Services Act, child care providers are required to report any ‘serious occurrences’ to their respective representative of High Five Child Care agency within 24 hours. Parents are also notified immediately about any incidents requiring first aid. Immediate medical assessment is called in case of incident involving loss of consciousness, choking or CPR.</p>

                                            <p>Supervision Of Students And Volunteer: Procedure And Responsibilities</p>

                                            <h5>In order to effective supervision of students and volunteer, following procedure is adopted by High Five Child Care Agency:</h5>
                                            <p>Before starting of education placement or volunteering by students and volunteer, all policies, strategies and plans are reviewed with the students as well as volunteer twice a year to ensure effective implementation of program. In case of any change in the policies or plans the same will be immediately discussed with the students and volunteer.</p>

                                            <p>Introductory meeting is arranged between the parents / guardians and students /volunteers.</p>
                                            <p>Training is imparted to students and volunteer on each child individual plan.</p>

                                            <p>Record of Vulnerable Sector Check (VSC) and Annual Offence Declaration for all students and volunteer is kept as required by the Child Care Centre’s criminal reference check policy and Ontario Regulation 137/15.</p>

                                            <p>The students and volunteers are supervised by a home child care provider at all times and not being permitted to be alone with any child</p>

                                            <p>Students and volunteers are directed to report any suspected child abuse or neglect as per the child and Family Services Act.</p>


                                            <p>Parent Issues And Concerns Policies And Procedures</p>

                                            <p>High Five Child Care agency had developed a policy to deal with parent issues and concern as per Ministry’s requirement.</p>

                                            <p>PURPOSE</p>

                                            <p>The intention of the policy is to provide parents with a clear and transparent procedure to follow when they have an issue or concern they wish to have addressed by High Five Child Care agency.</p>

                                            <p>POLICY</p>

                                            <p>High Five Child Care has developed written policies and procedures to addressed parents’ concerns. It is ensured that the policies and procedures are implemented by home child care providers, volunteers and students, persons who are ordinarily residents of the premises or regularly at the premises, home child care visitors and employees of the home child care agency. </p>


                                            <p>WHOM TO REPORT ISSUES / CONCERNS</p>

                                            <h5>The policy provides parents with direction on who will be contacted in various situations:</h5>
                                            <p>∙ If the concern or issue is directly related to a provider, it is to be addressed directly with the provider or home visitor). </p>
                                            <p>∙ If the concern is regarding a provider or an individual who is ordinarily a resident of the premises or regularly at the premises it is to be addressed with the home visitor). </p>
                                            <p>∙ If the concern is regarding the home visitor it is to be addressed with the licensee or board of directors). </p>
                                            <p>∙ If the concern is related to an allegation of abuse, Children’s Aid Society is to be contacted. </p>

                                            <p>RESPONSE TO PARENT</p>

                                            <p>When as issue or concern is brought forward by a parent they will be initially responded within 24 hours to acknowledge receipt of the issue/concern.</p>

                                            <p>CONFIDENTIALITY</p>

                                            <p>When a complaint is lodged or an issue or concern is brought forwarded by parents, every possible step is taken to maintain its confidentiality. Under no circumstances name of parents / guardians, children, home child care providers, residents of home child care premises, staff, student and volunteers shall be disclosed except when required to be disclosed to the Ministry of Education, College of Early Childhood Educators, law enforcement authorities or a Children’s Aid Society for legal reasons.</p>

                                            <p>ZERO TOLERANCE POLICY FOR CHILD ABUSE</p>

                                            <p>At High Five Child Care zero tolerance policy is maintained against child abuse, harassment and discrimination. </p>

                                            <p>REPORTING OF SUSPECTED ABUSE</p>

                                            <p>Every person who interacts with the children is required to report suspected cases of child abuse or neglect to the concern authorities. </p>

                                            <p>Parent / guardian having concerns that a child is being abused or neglected, are advised to immediately contact the local Children’s Aid Society directly. </p>

                                            <p>As per Duty to Report under the Child and Family Service Act, the persons who have knowledge of such concerns are bound to report the information to Children’s Aid Society.</p>

                                            <p>NATURE OF ISSUE AND PROCEDURE TO REPORT </p>
                                            <h5>There has been detailed procedure mentioned in the written policy of High Five Child Care guiding the parents to take appropriate steps for reporting various issues or concerns, briefly explained as under:</h5>

                                            <p>PROGRAME RELATED ISSUES / CONCERN</p>

                                            <p>Issues / concern relating to program i.e. indoor/ outdoor activities, policies, etc. be reported to the home child care provider or the home visitor supervisor directly.</p>

                                            <p>GENERAL ISSUES / CONCERN</p>

                                            <p>Issues / concern of general nature relating to operation or administration like placement of child, payment of fee, etc. be raised to the home visitor or the supervisor directly.</p>

                                            <p>PROVIDER OR STAFF RELATED ISSUES</p>

                                            <p>Issues relating to conduct of provider, home visitor, staff, etc. be raised to the individual or the supervisor directly.</p>
                                            <p>Issues concerning the conduct of the provider or staff that may put a child’s health, safety and well-being at risk should immediately be reported to High Five Child Care agency’s head office directly</p>
                                            <p> </p>
                                            <p>ISSUES RELATED TO OTHER PERSONS AT HOME PREMISES </p>

                                            <p>Issues relating to conduct of other persons / residents at home premises be raised to the home child care provider, visitor or the supervisor directly.</p>
                                            <p>Issues concerning the conduct of the other persons that may put a child’s health, safety and well-being at risk should immediately be reported to High Five Child Care agency’s head office directly.</p>

                                            <p>STUDENT / VOLUNTEER RELATED ISSUES</p>

                                            <p>Student/volunteer related issues / concerns be raised to the home child care provider, visitor or the supervisor directly.</p>
                                            <p>Issues concerning the conduct of the other persons that may put a child’s health, safety and well-being at risk should immediately be reported to High Five Child Care agency’s head office directly</p>

                                            <p>STEPS TO BE TAKEN TO RESOLVE THE ISSUES / CONCERN</p>

                                            <h5>Home child care provider, staff, visitor, supervisor or the concerned person to whom any issue or concern is reported by the parent shall take following steps immediately:</h5>
                                            <p>Address the issue / concern immediately, if possible.</p>
                                            <p>Arrange for a meeting with the parent within 2 days.</p>
                                            <p>Document the issue / concern in details including the date and time of receipt of the issue / concern, name, address and contact number of the person who raised the issue, nature of the issue, steps taken to resolve the issue</p>

                                            <p>If the notified person is unable to address the issue, contact number of the appropriate person be provided to the complainant</p>

                                            <p>Make sure that the process / investigation of the issue is completed within a specific period so fixed depending upon the nature of issue / concern.</p>

                                            <p>Outcome of the steps taken to resolve the issue / concern be intimated to the parents as well as to High Five Child Care head office. </p>

                                            <p>INTEREST ABOUT THE ACCUSED ABUSATION/NEGLECTION OF A CHILD</p>
                                            <p>The person or the parent of a child who has reasonable justification to accuse that a child has gone through (or can be) physical/emotional suffering or sexual harassment/abuse imposed by any person, will include these concerns and then report the impression directly to Children’s Aid Society (CAS).</p>
                                            <p>RESPONSE TO A SERIOUS OCCURRENCE </p>

                                            <p>Following procedure has been laid down by High Five Child Care to respond to all serious occurrences.</p>

                                            <p>STEPS REQUIRED BY THE CHILD CARE HOME PROVIDER</p>
                                            <p>1. Instantaneous </p>
                                            <p>Call for assistance from other persons at the premises</p>
                                            <p>First aid be provided, if required, according to Standard First Aid and CPR training</p>
                                            <p>Emergency services be called and directions provided by emergency services personnel be followed.</p>
                                            <p>Remove all other children from the scene</p>
                                            <p>Notify High Five Child Care agency</p>

                                            <p>2. Follow up </p>
                                            <p>Directions provided by third party authorities i.e. police, public health, Children Aid Society, etc.</p>
                                            <p>Children be supervised all the times.</p>

                                            <p>3. At the Earliest</p>
                                            <h5>Incident be recorded in:</h5>
                                            <p>a) The daily report</p>
                                            <p>b) The child’s medical record, if warranted,</p>
                                            <p>c) The Incident Report</p>
                                            <p>d) Copy of the report be provided to the parents.</p>

                                            <p>4. Summary be displayed at the premises</p>
                                            <p>Summary of the serious occurrence and action taken by the home child care provider be displaced at a prominent placed visible and accessible to parents.</p>

                                            <p>STEPS REQUIRED BY THE CHILD CARE AGENCY</p>

                                            <p>1. Instantaneous </p>
                                            <p>Child care visitor be send to the promises for assistance and support to the provider</p>
                                            <p>Assistance be provided to the persons present at the premises including children, students, volunteers </p>
                                            <p>Emergency services be called and directions provided by emergency services personnel be followed.</p>

                                            <p>2. Within 24 hours of intimation of the incident</p>
                                            <p>Incident be reported to the Ministry of Education providing pertinent information including description of the incident, date, time and place of occurrence, parties notified, action taken and outcome and current status of the incident and the children. </p>

                                            <p>3. Reporting of incident through Child Care Licensing System (CCLS)</p>
                                            <p>Serious occurrence be reported in Ministry of Education’s online Child Care Licensing System (CCLS)</p>

                                            <p>4. Summary of serious occurrence be provided to provider</p>
                                            <p>Summary of the serious occurrence be provided to the home child care provider for posting at the premises.</p>

                                            <p>5. Follow up </p>
                                            <p>Directions provided by third party authorities i.e. police, public health, Children Aid Society, etc.</p>
                                            <p>An internal review of the occurrence be conducted with the home child care provider, students and volunteers to reduce the probability of repeat occurrence.</p>
                                            <p>Support be provided to the children, parents, home child care provider, students and volunteers, if needed.</p>
                                            <p>Program statement, policies and procedures be reviewed setting out prohibited practices and expectation of promoting the safety, health and well-being of the children.</p>

                                            <p>MONITORING OF COMPLIANCE AND CONTRAVENIONS BY THE AGENCY</p>
                                            <p>To avoid any consequential damage arising from the advertent / inadvertent violation of prescribed rules / regulations, High Five Child Care Agency has made it mandatory to monitor home child care provider, student, volunteer and other persons present at the premises to assess whether or not policies, procedures and individualized plans are being implemented. </p>
                                            <p>MAINTENANCE OF RECORD</p>

                                            <p>CHILDREN’S RECORD</p>

                                            <h5>As per Child Care and Early Year Act, 2014, up-to-date records in respect of each child receiving child care at a child care center or at a premises where it oversees the provision of home child care for inspection by an inspector or program advisor at all times. Children’s record must consist of:</h5>
                                            <p>1. An application for enrolment signed by a parent of the child.</p>
                                            <p>2. Name, date of birth and home address of the child.</p>
                                            <p>3. Names, home addresses and telephone numbers of the parents of the child.</p>
                                            <p>4. Address and telephone number at which a parent of the child or other person can be reached in case of an emergency during the hours when the child receives child care.</p>
                                            <p>5. The names of persons to whom the child may be released.</p>
                                            <p>6. Date of admission of the child.</p>
                                            <p>7. The date of discharge of the child.</p>
                                            <p>8. The child’s previous history of communicable diseases, conditions requiring medical attention.</p>
                                            <p>9. Any symptoms indicative of ill health.</p>
                                            <p>10. A copy of any individualized plan.</p>
                                            <p>11. Written instructions signed by a parent of the child for any medical treatment or drug or medication that is to be administered during the hours the child receives child care.</p>
                                            <p>12. Written instructions signed by a parent of the child concerning any special requirements in respect of diet, rest or physical activity.</p>

                                            <p>Program Statement</p>

                                            <p>High Five Day Care based in Ontario functions under the Ministry of Education and is striving to offer child care in the best promising environment suitable to families, parents and their children through a flexible Program Statement.</p>

                                            <p>Execution of Program Statement</p>
                                            <p>The Program Statement has been developed within the parameters sets by the Ministry and is in consistency with the framework envisaged in Ministry’s How Does Learning Happen? Ontario’s Pedagogy for the Early Years (HDLH). All the stakeholders i.e. parents, families, children are taken onboard while setting up certain goals to be achieved through the Program Statement. These goals are achieved through active participation of not only the home child care provider but also the parents and the families. </p>

                                            <p>The main object of the program is to yield maximum positive results for children’s learning, development, health and well-being by active interaction with plans tailored to children physical and mental activities. The program statement caters each and every child’s personal ability and potential. To ensure updating of the program in align with Ministry’s policies, the program is reviewed annually. </p>

                                            <p>Keeping in mind the importance of the program statement, High Five Child Care provider gives special attention to the feedback of the parents with regard to the achieving the set goals through implementation of the program statement in letter and spirit. </p>

                                            <p>High Five Child Care Agency’s Program Goals & Approaches</p>
                                            <h5>Goal: a) To promote the health, safety, nutrition and well-being of the children:</h5>
                                            <h5> Approaches:</h5>
                                            <p>All children enrolled in our program have a record of immunization and health history on file before admission and are required to be updated annually.</p>
                                            <p>Site safety in the provider’s home is conducted initially before the provider stars child care in their home and then quarterly to ensure safety of the home.</p>
                                            <p>Children are provided nutritious meals as per Canada’s Food Guide, Canada’s Food Guide-First Nations, Nutrition for Healthy Term Infants Guide.</p>
                                            <p>All provider’s home are smoke free at all the time irrespective of the presence of children.</p>
                                            <p>Strict sanitary practices are adhered to by all homes.</p>

                                            <h5>b) To support positive and responsive interactions among the children, parents, child care providers and staff:</h5>
                                            <h5>Approaches:</h5>
                                            <p>High Five Child Care Agency’s providers focus on the needs of each child in care in consultation with parents to learn about the child’s liking, disliking, sleep preferences, food choice, etc. so that the child has a sense of belonging.</p>
                                            <p>Children are encouraged to interact in a positive manner with the provider, children and parents.</p>
                                            <p>Provider actively listen to the children where there is a problem and encourages cooperative play.</p>

                                            <h5>c) To encourage the children to interact and communicate in a positive way and support their ability to self-regulate:</h5>

                                            <h5>Approaches:</h5>
                                            <p>Providers role model the use of positive language and behavior at all times.</p>
                                            <p>Children are encouraged to take reasonable risk and test their limit through active ply and interaction.</p>
                                            <p>Children self regulation is fostered and supported through positive adult child interaction with their providers.</p>
                                            <h5>d) To foster children’s exploration, play and inquiry:</h5>
                                            <h5>Approaches:</h5>
                                            <p>The children are provided with opportunities to explore and make choices in a safe and sound environment.</p>
                                            <p>Open ended materials are provided to the children to engage them in meaningful play experience.</p>
                                            <p>Our program caters for each stage of development as the child moves through various stage according to their ability.</p>

                                            <h5>e) To plan for and create positive learning environments:</h5>
                                            <h5>Approaches:</h5>
                                            <p>Providers have the resource of High Five Child Care Program to support the development of activities for indoor and outdoor child-initiated / adult-supported learning.</p>

                                            <h5>f) To incorporate indoor and outdoor play as well as rest and quiet time:</h5>
                                            <h5>Approaches:</h5>
                                            <p>Through daily observations and interactions, the provider plan indoor and outdoor activities based on the children interests and the development of each child in the care.</p>
                                            <p>Daily 2 hours outdoor play is allowed to all children (infant, toddler, preschool, JK/SK, and school age) receiving care for 6 or more hours a day.</p>
                                            <p>Children may sleep, rest or engage in quiet activities based on their individual needs.</p>
                                            <p>Parents are consulted in respect of their child’s sleep arrangements. </p>

                                            <h5>g) To communicate with parents about the program and their children:</h5>
                                            <h5>Approaches:</h5>
                                            <p>At the time of enrolment of the child, a meeting is arranged between the provider and the parent to learn in details about the program.</p>
                                            <p>Parents are always welcome to contact the Agency with their questions and concerns about their children, program or provider.</p>
                                            <p>Parents are updated regularly about any change in the program and the progress of their children through emails, phone calls.</p>

                                            <p>h) To involve local community partners”</p>
                                            <h5>Approaches:</h5>
                                            <p>Children are often taken for walks in the neighbourhood including libraries, supermarkets and parts.</p>
                                            <p>Families are supported by working with Resource teachers and interventionists from the local neighbourhood.</p>
                                            <h5>i) To support staff, home child care providers in relation to professional learning:</h5>
                                            <h5>Approaches:</h5>
                                            <h5>The staff, providers and others who interact with the children at home child care premises are encouraged to enhance their skills to ensure quality early learning experiences for children by:</h5>
                                            <p>a. participate in professional learning coordinated by licensed home child care agencies, municipality or other early years programs in the community. </p>
                                            <p>connecting with community by participating in its programs and accessing its resources (e.g., visiting and using local libraries, recreation centres, parks, and family support programs) </p>

                                            <h5>k) To review the impact of the program statement:</h5>
                                            <h5>Approaches:</h5>
                                            <p>Valued feedback is requested from the parents on the program statement to assess the effectiveness of the program.</p>
                                            <p>The program statement is reviewed annually (or as and when some changes are required immediately) and any change to communicated to the parents immediately.</p>
                                            <p>A record of all the feedback from the parents, visitors, providers, staff be documented to have a clear picture whether the program statement is being implemented strictly and effectively and what is the impact of the program statement in achieving the desired goals. </p>

                                            <p>GLOSSARY</p>
                                            <p>Child: A person who is younger than 13 years old. </p>

                                            <p>Child Care: For the purposes of the CCEYA, child care is defined as the provision of temporary care for or supervision of children in any circumstance other than in exempt circumstances for a period of less than 24 hours. </p>

                                            <p>Child Care and Early Years Act, 2014 (the CCEYA): The legislation that regulates child care in Ontario. </p>

                                            <p>Home Child Care Provider: The person in charge of the children in a premises where home child care is provided. </p>

                                            <p>Home Child Care Visitor: An employee of the home child care agency who will provide support at and monitor each premises and will be responsible to the licensee. </p>

                                            <p>Individualized Plan: A written plan that sets out how the licensee will support a child with an anaphylactic allergy or a child with special needs that is developed in consultation with parents and other professionals. </p>

                                            <p>Inspector: An employee of the Ministry appointed by the Minister. Inspector’s powers and duties include the ability to enter and inspect a child care center, a premise where home child care is provided, and a premise where a home child care agency is located; and examine records. Program advisors and enforcement staff have been appointed as inspectors. </p>

                                            <p>License: A document issued by the Ministry of Education to a licensee providing the authority to operate a specific child care program. A license can be regular or provisional and may have conditions. </p>

                                            <p>Licensee: An individual, corporation, or First Nation who holds a license issued under the Child Care and Early Years Act, 2014. Ordinarily a Resident of the Premises: Individuals who use the premises as a primary residence for at least some period during the year (e.g., the provider’s spouse, adult children, adult dependents, etc.). </p>

                                            <p>Parent: A person having lawful custody of a child or a person who has demonstrated a settled intention to treat a child as a child of his or her family (all references to parent include legal guardians, but will only be referred to as “parent” in this Manual). Premises: a building, together with its land (for example, the backyard) where the home child care provider primarily resides. The licensee or designate is expected to visit the premises to verify compliance with the CCEYA and O. Reg. 137/15. </p>

                                            <p>Program Advisor: An employee of the Ministry of Education who is authorized under the CCEYA to inspect licensed child care programs. Program advisors support licensees and applicants to achieve and maintain compliance with licensing requirements and respond to complaints and serious occurrences reported about and by child care programs. Program advisors have been appointed as inspectors under the Act. </p>

                                            <p>Regularly at the Premises: An individual who is present at the premises during hours in which care is provided often enough that children in care are able to recognize the individual. This would include persons who are present frequently during a short period of time (e.g., visiting family members) or repeatedly (e.g., the provider’s friend who visits the premises once a week, or a neighbor who visits the premises every other month to provide tutoring to the providers own child). </p>

                                            <p>Relative: With respect to a child, a person who is the child’s parent, sibling, grandparent, great-uncle, great-aunt, uncle, aunt, cousin, whether by blood, through a spousal relationship or through adoption. </p>

                                            <p>Resource Teacher: A person who supports program staff/home child care providers and parents in working with children with special needs who attend licensed child care. </p>
                                        </div>
                                        <div class="d-flex align-item-center justify-content-center gap-3">
                                            <input type="text" class="form-control form-control-solid" placeholder="Enter Parent Signature" name="contract_signature" value="{{ old('contract_signature', $parent->contract_signature ?? '' )}}" required/>
                                            <input type="date" class="form-control" name="contract_signature_date" value="{{ old('contract_signature_date', $parent->contract_signature_date ? date('Y-m-d', strtotime($parent->contract_signature_date)) : ''  ) }}" required>
                                        </div>                                            
                                    </div>

                                    @role('Parent')
                                    <div class="modal-footer flex-right">
                                        <!--begin::Button-->
                                        <!--end::Button-->
                                        <!--begin::Button-->
                                        <button type="submit" id="kt_modal_add_event_submit" class="btn btn-primary">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                        <!--end::Button-->
                                    </div>
                                    @endrole

                                </div>
                                <!--end::Modal body-->
                                <!--begin::Modal footer-->

                                <!--end::Modal footer-->
                            </form>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 28-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->

                <!--end::Col-->
                <!--begin::Col-->

                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    <!--begin::Footer-->

    <!--end::Footer-->
</div>


@endsection