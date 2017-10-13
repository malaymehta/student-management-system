<!-- footer content -->
<footer>
    <div class="pull-right">
       {{date('Y')}} &copy; ArsenalTech
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>

<!-- jQuery -->
<script src="{!! asset('theme/js/jquery.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/plugins/jquery-1.12.4.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/plugins/jquery-ui.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/plugins/jquery.validate.js') !!}"></script>
<!-- TimePicker-->
<script type="text/javascript" src="{!! asset('js/plugins/jquery.timepicker.min.js') !!}"></script>
<!-- Bootstrap -->
<script src="{!! asset('theme/js/bootstrap.min.js') !!}"></script>
<!-- Dropzone js -->
<script type="text/javascript" src="{!! asset('js/plugins/dropzone.js') !!}"></script>
<!-- DataTables -->
<script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script src="{!! asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') !!}"></script>
<script src="{!! asset('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') !!}"></script>
<!-- bootstrap-progressbar -->
<script src="{!! asset('theme/js/bootstrap-progressbar.min.js') !!}"></script>
<!-- Custom Theme Scripts -->
<script src="{!! asset('theme/js/custom.min.js') !!}"></script>

@yield('custom_js')

</body>
</html>