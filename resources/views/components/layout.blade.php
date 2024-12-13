<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<x-headComponent></x-headComponent>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper"> <!--begin::Header-->
       <x-nav></x-nav>
       <x-aside></x-aside>
        <main class="app-main"> <!--begin::App Content Header-->
           {{$slot}}
        </main> <!--end::App Main--> <!--begin::Footer-->
       <x-footer></x-footer>
    </div> <!--end::App Wrapper--> <!--begin::Script--> <!--begin::Third Party Plugin(OverlayScrollbars)-->
   <x-script></x-script>
</body><!--end::Body-->

</html>
