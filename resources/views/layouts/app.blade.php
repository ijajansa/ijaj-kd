<!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--favicon-->
        <!-- <link rel="icon" href="https://dsptechnologies.co.in/assets/title.png" type="image/png" /> -->
        <!--plugins-->
        <link href="{{config('app.baseURL')}}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
        <link href="{{config('app.baseURL')}}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
        <link href="{{config('app.baseURL')}}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
        <link href="{{config('app.baseURL')}}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
        <link href="{{config('app.baseURL')}}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

        <!-- loader-->
        
        <link href="{{config('app.baseURL')}}/assets/css/pace.min.css" rel="stylesheet" />
        <script src="{{config('app.baseURL')}}/assets/js/pace.min.js"></script>
        <!-- Bootstrap CSS -->
        <link href="{{config('app.baseURL')}}/assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{config('app.baseURL')}}/assets/css/bootstrap-extended.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
        <link href="{{config('app.baseURL')}}/assets/css/app.css" rel="stylesheet">
        <link href="{{config('app.baseURL')}}/assets/css/icons.css" rel="stylesheet">
        <!-- Theme Style CSS -->
        <link rel="stylesheet" href="{{config('app.baseURL')}}/assets/css/dark-theme.css" />
        <link rel="stylesheet" href="{{config('app.baseURL')}}/assets/css/semi-dark.css" />
        <link rel="stylesheet" href="{{config('app.baseURL')}}/assets/css/header-colors.css" />


        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
        <link rel="stylesheet" href="{{config('app.baseURL')}}/assets/plugins/notifications/css/lobibox.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <title>Manchar Nagarpanchayat - Admin Dashboard</title>
    </head>

    <body>
        
        <!--wrapper-->
        <div class="wrapper">

            @include('layouts.sidebar');
            @include('layouts.header');
            @yield('content');

            <!--start overlay-->
            <div class="overlay toggle-icon"></div>
            <!--end overlay-->
            <!--Start Back To Top Button-->
            <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
            <!--End Back To Top Button-->
            <footer class="page-footer">
                <p class="mb-0">Copyright © {{date('Y')}}. All right reserved.</p>
                <input type="hidden" name="push_token" id="push">
            </footer>
        </div>
        <!--end wrapper-->




        <!-- Bootstrap JS -->

        <script src="{{config('app.baseURL')}}/assets/js/bootstrap.bundle.min.js"></script>
        <!--plugins-->
        <script src="{{config('app.baseURL')}}/assets/js/jquery.min.js"></script>
        <script src="{{config('app.baseURL')}}/assets/plugins/simplebar/js/simplebar.min.js"></script>
        <script src="{{config('app.baseURL')}}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
        <script src="{{config('app.baseURL')}}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
        <script src="{{config('app.baseURL')}}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="{{config('app.baseURL')}}/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="{{config('app.baseURL')}}/assets/plugins/chartjs/js/Chart.min.js"></script>
        <script src="{{config('app.baseURL')}}/assets/plugins/chartjs/js/Chart.extension.js"></script>
        <script src="{{config('app.baseURL')}}/assets/js/index.js"></script>
        <!--notification js -->
        <script src="{{config('app.baseURL')}}/assets/plugins/notifications/js/lobibox.min.js"></script>
        <script src="{{config('app.baseURL')}}/assets/plugins/notifications/js/notifications.min.js"></script>
        <script src="{{config('app.baseURL')}}/assets/plugins/notifications/js/notification-custom-script.js"></script>

        <!--app JS-->
        <script src="{{config('app.baseURL')}}/assets/js/app.js"></script>
        <script src="{{config('app.baseURL')}}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
        <script src="{{config('app.baseURL')}}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

        <!--notification js -->
        <script src="{{config('app.baseURL')}}/assets/plugins/notifications/js/lobibox.min.js"></script>
        <script src="{{config('app.baseURL')}}/assets/plugins/notifications/js/notifications.min.js"></script>
        <script src="{{config('app.baseURL')}}/assets/plugins/notifications/js/notification-custom-script.js"></script>
        

        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            } );
        </script>
        <script>
            $(document).ready(function() {
                var table = $('#example2').DataTable( {
                    lengthChange: false,
                    buttons: [ 'copy', 'excel', 'pdf', 'print']
                } );

                table.buttons().container()
                .appendTo( '#example2_wrapper .col-md-6:eq(0)' );
            } );
        </script>

        <script type="text/javascript">
         @if(Session::has('message'))
         var type = "{{ Session::get('alert-type', 'info') }}";
         switch(type){
            case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

            case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

            case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

            case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
        }
        @endif
    </script>

<!-- Firebase Push Notification -->
<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js"></script>
<script src="assets/plugins/select2/js/select2.min.js"></script>

<script>
    var firebaseConfig = {
    apiKey: "AIzaSyA1VolvVtHDeg0b1VyRcRoXKwQfNeMOfYM",
    authDomain: "triple-brook-270004.firebaseapp.com",
    projectId: "triple-brook-270004",
    storageBucket: "triple-brook-270004.appspot.com",
    messagingSenderId: "570334724652",
    appId: "1:570334724652:web:23e6f2e193d99aa4480789"
};
    firebase.initializeApp(firebaseConfig);
    const messaging=firebase.messaging();

    function IntitalizeFireBaseMessaging() {
        messaging
            .requestPermission()
            .then(function () {
                console.log("Notification Permission");
                return messaging.getToken();
            })
            .then(function (token) {
                console.log("Token : "+token);
                $("#push").val(token);
                if(token.length!=0)
                {
                    $.ajax({
                        url: "{{config('app.baseURL')}}/user/token",
                        type: 'GET',
                        data: {token:token},
                        success:function(data)
                        {
                                // console.log(data);
                        }
                    });
                }
            })
            .catch(function (reason) {
                console.log(reason);
            });
    }

    messaging.onMessage(function (payload) {
        console.log(payload);
        const notificationOption={
            body:payload.notification.body,
            icon:payload.notification.icon
        };

        if(Notification.permission==="granted"){
            var notification=new Notification(payload.notification.title,notificationOption);

            notification.onclick=function (ev) {
                ev.preventDefault();
                window.open(payload.notification.click_action,'_blank');
                notification.close();
            }
        }

    });
    messaging.onTokenRefresh(function () {
        messaging.getToken()
            .then(function (newtoken) {
                console.log("New Token : "+ newtoken);
            })
            .catch(function (reason) {
                console.log(reason);
                //alert(reason);
            })
    })
    IntitalizeFireBaseMessaging();
</script>

</body>

</html>
