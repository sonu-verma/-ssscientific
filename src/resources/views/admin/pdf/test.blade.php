@extends('admin.layouts.proposal-pdf', ['title' => 'Proposal','layout' => $layout])
@section('content')
    @if(!$model)
        <div><h1>Proposal Not generated,Please generate proposal first</h1></div>
    @else
        <div id="firstPage" class="commonPageCss">
            <div class="container">
                <div class="row margin-top-40">
                    <img src="{{ public_path('images/proposal-pdf/pdf-logo.png')  }}" style="width: 600px; height: auto" class="logo">
                </div>
                <div class="row" style="margin-top: 40px;margin-left: 40px;margin-right: 0;margin-bottom: 0">
                    <h2 class="extra-bold" style="font-size: 75px;color: #fff;">
                        DESIGNS THAT INSPIRE
                        <span style="font-size: 20px; vertical-align: top;padding-top: 20px">TM</span></h2>

                </div>
                <div class="row" style="font-size: 25px;margin-left: 15px;">
                    <ul class="main--list">
                        <li>Home Staging</li>
                        <li>Furniture Sales</li>
                        <li>Furniture Rental</li>
                    </ul>
                </div>

                <div class="row margin-top-40" style="padding:0;width: 100%;background-color: #fff;border-bottom-right-radius: 150px;">

                    <p style="color: #3a5a66; font-size: 30px;margin-left: 50px;padding-right: 50px;padding-bottom: 50px; line-height: 25px">
                        You can only sell your home once, don't leave money on table!
                    </p>
                </div>

                <p style="position: absolute;bottom: -50px;margin-left: 50px;color: #fff;font-size: 20px;">www.chicagostaging.com</p>

            </div>
        </div>
        <div class="pdf-content">

            <div class="add--margin">
                <table class="row page_break" style="width: 100%">
                    <td width="60%">

                        <p style="margin: 0;padding: 0">{{ $model?$model->user->full_name:'' }}</p>
                        <p style="margin: 0;padding: 0">Homeowner</p>
                        <div class="row ml-4" style="margin: 0;padding: 0">
                            <ul class="list" style="list-style-type: none;padding: 0">
                                <li>
                                    {{ $model?$model->company_name:'' }}
                                </li>
                            </ul>
                        </div>
                        <p class="margin-top-20 margin-bottom-0">
                            Staging Relationship Opportunity:
                        </p>
                        <p class="w-100 margin-top-0 margin-bottom-0 semi-bold" style="margin: 0;padding: 0;line-height: 20px">{{ $model?$model->property_address:'' }}</p>
                        <p class="margin-top-40">
                                <?php
                                $firstName = 'N/A';
                                if($model && $model->user){
                                    $firstName = $model->user->first_name;
                                }
                                ?>
                            Dear {{ $firstName }},
                        </p>
                    </td>
                    <td width="40%">
                        <p class="text-center" style="font-size: 25px">
                            <span style="border-bottom: 5px solid #ffc000">{{ $model? __date(strtotime($model->created_at),'F j, Y'):'' }}</span>
                        </p>
                        <div style="text-align: right; position: relative">
                            <img src="{{ public_path('images/proposal-pdf/sofa.png')  }}" alt="Sofa" style="width: 350px;height: 250px;position: absolute;right: 0;" />
                        </div>
                    </td>
                </table>
                <p class="" style="padding: 0;page-break-inside: avoid">
                    We thank you for the opportunity.

                    Staging has a proven track record of helping homeowners sell their homes faster, and for
                    more money. The National Association of Realtors conducted a study that found nine out
                    of ten potential home buyers that visit a property cannot see the homes potential.
                    We can help all whom visit your property visualize your homes potential, and see themselves
                    living and enjoying life there.  The Real Estate Staging Association studied 97 homes that
                    were previously on the market for an average of 181 days before the homeowner called a
                    professional staging company.  After the homes were staged, they were sold, on average,
                    in 60 days.  This is 67% less time on market! <br/><br/>

                    Phoenix Rising’s Amazing Results: In {{ date("Y",strtotime("-1 year")) }} PRHS assisted our clients in selling their
                    homes for $1,800,000 over list price! <br/><br/>

                    Please know our objective is simple:  Maximize the value of your property, stage a home
                    so that it leaves a lasting, positive impression on the potential buyer, resulting in
                    you selling your home for more money in less time.  We take an all-encompassing approach
                    to staging your home.  We would like an opportunity to earn your trust, confidence and to
                    become your “go to” Staging and Design Company.  With that in mind, I propose the following:
                </p>
                {{--                <h5 class="margin-top-20">About the Home</h5>--}}


            </div>

            <div class="" style="margin-top: 0">
                <p class="margin-top-30 page--title semi-bold" style="margin: 0"><span class="bg--area">AREAS TO BE STAGED</span></p>

            </div>

            @if($model->notes)
                <div class="">
                    <ul class="margin-top-20" style="list-style-type: none;">
                        <li>
                            <b>Note:</b>
                            {!! $model->notes !!}
                        </li>
                    </ul>
                </div>
            @endif


            <div class="">
                <p class="margin-top-20 page--title semi-bold" style="margin-bottom:0"><span class="bg--area">PROPOSAL INCLUDES</span></p>
                <div class="add--margin">
                    <table width="100%">
                        <tr>
                            <td width="60%">
                                <ul class="dotted-list padding-0 proposal_included_li" style="margin-left: -14px;">
                                    <li style="list-style: none">Design consultation, plan and execution.</li>
                                    <li style="list-style: none">Installation of furniture, accessories and art that will enhance look and feel of the home.</li>
                                    <li style="list-style: none">Removal of Phoenix Rising furniture and accessories.</li>
                                </ul>
                            </td>
                            <td width="40%">
                                <div style="text-align: right; position: relative">
                                    <img src="{{ public_path('images/proposal-pdf/tables.png')  }}" alt="Tables" style="width: 250px;height: 350px;position: absolute;right: 0;top: -250px" />
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="add--margin">
                <p class="margin-top-20" style="page-break-inside: avoid">
                    We would be honored to assist you in preparing your listing for sale.  You can contact
                    me at 312-450-8365 with any questions.  Please know we never take business for granted
                    and will work hard every day to earn your continued trust and confidence.
                </p>
                <p class="margin-top-20">Sincerely,<br/>
                    <span class="semi-bold">Your Staging Team</span>
                </p>
            </div>


            <!-- Fixed Footer -->
            <div id="footer" class="add--margin margin-top-40">
                <p class="semi-bold border-bottom disclaimer">
                    <i>
                        Please note this proposal may have been written without viewing the home and we plan
                        to deliver a Stunning Staging Design. If there are specific requests when
                        designer visits the home, contract price may need to be adjusted.
                    </i>
                </p>

                <table width="100%" class="reach--links">
                    <tr>
                        <td class="">
                            <i><img src="{{ public_path('images/proposal-pdf/web.png')  }}" class="logo web"></i>
                            <a href="https://www.chicagostaging.com" style="text-decoration: none">www.chicagostaging.com</a></td>
                        <td class="">
                            <i><img src="{{ public_path('images/proposal-pdf/tel.png')  }}" class="logo tel"></i>
                            <a href="#">312-450-8365</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <i><img src="{{ public_path('images/proposal-pdf/loc.png')  }}" class="logo loc"></i>
                            <a href="#">105 E Oakton St, Des Plaines, IL 60018</a>
                        </td>
                        <td class="">
                            <i><img src="{{ public_path('images/proposal-pdf/email.png')  }}" class="logo email"></i>
                            <a href="mailto: staging@chicagostaging.com" style="text-decoration: none">ssscientif.net</a></td>
                    </tr>
                </table>
            </div>
        </div>
    @endif
    <style>

        @page {
            size: A4;
            margin: 0;
            padding: 0;
        }
        @font-face {
            font-family: 'Poppins';
            font-weight: normal;
            src: url({{ storage_path('fonts/poppins/poppins.ttf') }}) format("truetype");
        }
        @font-face {
            font-family: 'Poppins Light';
            font-weight: normal;
            src: url({{ storage_path('fonts/poppins/Poppins-Light.ttf') }}) format("truetype");
        }
        @font-face {
            font-family: 'Poppins Medium';
            font-weight: 500;
            src: url({{ storage_path('fonts/poppins/poppins-medium.ttf') }}) format("truetype");
        }
        @font-face {
            font-family: 'Poppins SemiBold';
            font-weight: 600;
            src: url({{ storage_path('fonts/poppins/Poppins-SemiBold.ttf') }}) format("truetype");
        }
        @font-face {
            font-family: 'Poppins Bold';
            font-weight: 700;
            src: url({{ storage_path('fonts/poppins/Poppins-Bold.ttf') }}) format("truetype");
        }
        @font-face {
            font-family: 'Poppins ExtraBold';
            font-weight: 800;
            src: url({{ storage_path('fonts/poppins/poppins-extra-bold.ttf') }}) format("truetype");
        }

        #firstPage {
            font-family: 'Poppins Medium';
            background-image: url({{ public_path('images/proposal-pdf/pdf-bg.png') }}) !important;
            font-weight: 500;
        }

        .commonPageCss {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            height: 150%;
            width: 100%;
            background-size: cover !important;
            z-index: 111;
            padding: 0 !important;
            margin: 0 !important;
        }

        body {
            font-size: 15px;
            background-image: url({{ public_path('images/proposal-pdf/deck.jpg') }});
            height: 100%;
            width: 100%;
            background-size: cover;
            padding: 80px 0;
            z-index: 11;
        }

        table.collapse-border {
            border: 1px solid black;
            border-collapse: collapse;
        }


        .main--list {
            list-style-type:  disc;
            color: #fff;
            margin-left: 15px;
            vertical-align: middle;

        }

        .main--list li {
            padding-bottom: 25px;
            line-height: 20px;
        }

        .pdf-content {
            font-family: 'Poppins Medium';
            page-break-after: auto;
            font-weight: 500;
        }

        .list--type-2 li {
            padding-left: 20px;
        }

        .semi-bold {
            font-family: 'Poppins SemiBold';
            font-weight: 600;
        }

        .bold {
            font-family: 'Poppins Bold';
            font-weight: 700;
        }

        .extra-bold {
            font-family: 'Poppins ExtraBold';
            font-weight: 800;
            line-height: 50px;
        }

        .add--margin {
            margin: 0 50px;
        }

        .page--title {
            background-color: #FFC847;
            font-size: 30px;
            position: relative;
            height: 80px;
            border-top-right-radius: 150px;
            width: 60%;
        }

        .circle--title {
            background-color: #FFC847;
            font-size: 20px;
            position: relative;
            height: 50px;
            border-radius: 0 20px 20px 0;
            width: 58%;
            padding-right: 0;
        }

        .bg--area {
            text-transform: capitalize;
            position: absolute;
            padding-left:50px;
        }

        .box--with-border {
            border: 3px solid #000000;
            border-radius: 30px;
            position: relative;
            padding: 20px 30px;
        }

        .box--with-border .title--box {
            background: #FFC847;
            position: absolute;
            height:25px;
            top: -23px;
            left: 8px;
            border-radius: 20px;
            padding: 1px 20px 10px 20px;
            text-align: center;
            vertical-align: middle;
        }

        .page_break {page-break-before: always;}

        .text-center {
            text-align: center;
        }

        .border-bottom {
            border-bottom: 2px solid grey;
        }

        .grey-font {
            color: grey;
        }
        .container {
            max-width: 700px;
        }

        .dotted-list {
            list-style-type:  disc;
            color: #000;
            margin-left: 15px;

        }

        .dotted-list li {
            line-height: 5px;
            vertical-align: middle;
            padding-bottom: 20px
        }

        .list-circle {
            list-style-type:  circle;
        }
        .pad-left-list {
            padding-left: 16px;
        }

        .display-flex {
            display: flex;
        }
        input[type=checkbox] {
            width: 20px;
            height: 20px;
            vertical-align: middle;
            margin-left: 5px;
            margin-right: 5px;
            cursor: pointer;
        }

        .list {
            padding-left: 15px;
            padding-top: 15px;
        }

        .list-2 li label {
            width: 35%;
            margin-bottom: 0;
            padding-top: 8px;
        }
        .list-2 li {
            margin-top: 15px;
        }
        .list-2 li input {
            width: 25%;
            margin-top: 10px;
        }
        .list-2 li select {
            width: 25%;
            margin-left: 30px;
            font-size: 12px;
            padding-left: 10px;
        }

        .list-2 li .price {
            margin-left: 15px;
            margin-top: 10px;
        }

        .dot-before li:before {
            content:"• ";
            font-size: 18px;
            padding-right: 5px;
        }
        .list input[type=checkbox] {
            vertical-align: middle;
            margin-right: 10px;
        }

        label, p {
            padding-right: 20px;
            vertical-align: sub;
            color: #000;
            /*font-weight: 300;*/
        }
        .input-field {
            border-top: none;
            border-left: none;
            border-right: none;
            vertical-align: unset;
            height: 20px;
            font-size: 12px;
        }
        .logo {
            width: 350px;
            text-align: center;
        }
        .preview-label {
            padding-right: 2px;
            vertical-align: baseline;
            margin: 0;
        }
        .margin-15 {
            margin-left: -4px;
        }
        .padding-50 {
            padding-left: 50px;
        }
        .margin-top-40 {
            margin-top: 40px !important;
        }
        .margin-top-30 {
            margin-top: 30px !important;
        }
        .margin-top-20 {
            margin-top: 20px !important;
        }
        .margin-top-10 {
            margin-top: 10px !important;
        }

        .margin-top-0 {
            margin-top: 0 !important;
        }
        .margin-bottom-0 {
            margin-bottom: 0 !important;
        }

        .margin-bottom-30 {
            margin-bottom: 30px !important;
        }

        .padding-0 {
            padding: 0;
        }

        #footer {
            /*position: absolute;*/
            /*left: 0px;*/
            /*bottom: -70px;*/
            /*right: 0px;*/
            font-family: 'Poppins Medium';
            font-weight: 500;
        }

        #footer .disclaimer {
            font-size: 16px;
            font-weight: 500;
            padding-bottom: 15px;
            padding-right: 70px;
        }

        #footer .reach--links td, #footer .reach--links td a {
            font-size: 14px;
            color: #000000;
            margin-bottom: 0;
        }

        #footer .reach--links td.web--block a {
            vertical-align: top;
            cursor: pointer;
        }

        #footer .reach--links td a {
            vertical-align: top;
            cursor: pointer;
            text-decoration: none;
        }

        #footer .reach--links td i img {
            height: 40px;
        }
        #footer .reach--links td i img.web {
            height: 40px;
            width: 60px;
        }
        #footer .reach--links td i img.tel {
            width: 50px;
        }
        #footer .reach--links td i img.loc {
            width: 65px;
        }
        #footer .reach--links td i img.email {
            width: 50px;
        }
        .proposal_included_li li:before
        {
            content: "•";
            list-style: none;
            vertical-align: middle;
            margin-left: 10px;
            /*padding-right: 20px;*/
            padding: 10px;
            box-sizing: border-box;
            font-size: 20px;
        }
        .other_info_included_li li:before
        {
            content: "•";
            list-style: none;
            vertical-align: middle;
            margin-left: -10px;
            /*padding-right: 20px;*/
            padding: 5px !important;
            box-sizing: border-box;
            font-size: 20px;
        }
    </style>
@endsection
