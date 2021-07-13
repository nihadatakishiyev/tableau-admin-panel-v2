@extends('adminlte::page')

@section('content')
    <div class="container py-3">
        <div class="row">

            <div class="col-10 mx-auto">
                <h1 class="display-4">Tez-tez soruşulan suallar</h1>
                <br>
                <div class="accordion" id="faqExample">
                    <div class="card">
                        <div class="card-header p-2" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    1. Nə üçün sayta daxil olarkən <strong>"Your connection is not private"</strong> xəbərdarlıq mesajı ilə qarşılaşıram?
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#faqExample">
                            <div class="card-body">
                                Əgər sayta daxil olarkən <strong>"Your connection is not private"</strong> mesajı ilə qarşılaşırsınızsa və ya saytı istifadə edərkən brauzerin
                                axtarış hissəsində <strong>"Not secure"</strong> yazısı çıxırsa, deməli sizin komputeriniz domendə deyil və müvafiq SSL sertifikatların
                                aktivləşdirilməsi üçün <strong>IT əməkdaşları ilə əlaqə saxlamanız zəruridir.</strong> <br> <br>

                                <img src="{{asset('photos/security_warning.png')}}" class="img-fluid" alt="">
                                <br> <br>
                                <img src="{{asset('photos/chrome_not_secure.PNG')}}" class="img-fluid" alt="">
                                <img src="{{asset('photos/firefox_not_secure.PNG')}}" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header p-2" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    2. Nə üçün <strong>Google Chrome</strong> ilə sayta daxil olduqda hesabatları görə bilmirəm və ya <strong>"Sign in to Tableau Server"</strong> yazısı ilə qarşılaşıram?
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqExample">
                            <div class="card-body">
                                İlk öncə <strong>1-ci sualda qeyd olunan problemin sizdə yaşanmadığından əmin olun.</strong> Növbəti olaraq əgər Google Chrome brauzerini
                                <strong>"Incognito"</strong> rejimdə istifadə edirsinizsə, brauzerin parametrlərinə daxil olaraq aşağıdakı dəyişikliyi etməyiniz lazımdır:
                                <br> <br>
                                <h5><em>Google Chrome -> Settings -> Cookies and other site data -> Allow all cookies</em></h5>
                                <br>
                                <img src="{{asset('photos/sign_in_to_tableau.png')}}" class="img-fluid"  alt="">
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header p-2" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    3. Nə üçün <strong>cd:qi</strong> ilə sayta daxil olduqda hesabatları görə bilmirəm?
                                </button>
                            </h5>                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqExample">
                            <div class="card-body">
                                İlk öncə <strong>1-ci sualda qeyd olunan problemin sizdə yaşanmadığından əmin olun.</strong> Növbəti olaraq <strong>Safari</strong> brauzerinin parametrlərinə daxil olaraq
                                <strong>"Prevent cross-site tracking"</strong> seçimindən işarəni yığışdırın:
                                <br> <br>
                                <h5><em>Safari -> Preferences -> Privacy -> Prevent cross-site tracking</em></h5>
                                <br>
                                <img src="{{asset('photos/safari_cross.jpg')}}" class="img-fluid"  alt="">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--/row-->
    </div>
    <style>
        .content-header {
            padding: 0;
        }
    </style>

@stop
