

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="{{ asset('admin-assets/js/AdminLTE.min.js') }}"></script>
<script>
    var sidebarOpen;

    $(function() {
        sidebarOpen = Cookies.get('adminSidebar') == 'open';

        if (!sidebarOpen) {
            $('body').addClass('sidebar-collapse');
        }
    });

    function toggleSidebar()
    {
        if (!sidebarOpen) {
            sidebarOpen = true;
            Cookies.set('adminSidebar', 'open');
        } else {
            sidebarOpen = false;
            Cookies.set('adminSidebar', 'collapsed');
        }
    }
</script>
@yield('additional_js')
