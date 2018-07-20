var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

// Gentelella vendors path : vendor/bower_components/gentelella/vendors

elixir(function(mix) {

    /********************/
    /* Copy Stylesheets */
    /********************/

    // Bootstrap
    mix.copy('bower_components/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css', 'public/css/bootstrap.min.css');

    // Font awesome
    mix.copy('bower_components/gentelella/vendors/font-awesome/css/font-awesome.min.css', 'public/css/font-awesome.min.css');

    // Gentelella
    mix.copy('bower_components/gentelella/build/css/custom.min.css', 'public/css/gentelella.min.css');

    // bootstrap-daterangepicker
    mix.copy('bower_components/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css', 'public/css/daterangepicker.css');

    // dropzone
    mix.copy('bower_components/gentelella/vendors/dropzone/dist/min/dropzone.min.css', 'public/css/dropzone.min.css');

    // datatables bootstrap
    mix.copy('bower_components/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css', 'public/css/dataTables.bootstrap.min.css');

    //NProgress
    mix.copy('bower_components/gentelella/vendors/nprogress/nprogress.css', 'public/css/nprogress.css');

    //icheck
    mix.copy('bower_components/gentelella/vendors/iCheck/skins/flat/green.css', 'public/css/green.css');
    mix.copy('bower_components/gentelella/vendors/iCheck/skins/flat/green@2x.png', 'public/css/green@2x.png');

    //progress bar
  mix.copy('bower_components/gentelella/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css', 'public/css/bootstrap-progressbar-3.3.4.min.css');

  //full calendar
    mix.copy('bower_components/gentelella/vendors/fullcalendar/dist/fullcalendar.min.css', 'public/css/fullcalendar.min.css');
    mix.copy('bower_components/gentelella/vendors/fullcalendar/dist/fullcalendar.print.css', 'public/css/fullcalendar.print.css');

    //prettify
    mix.copy('bower_components/gentelella/vendors/google-code-prettify/bin/prettify.min.css', 'public/css/prettify.print.css');

    //select2
    mix.copy('bower_components/gentelella/vendors/select2/dist/css/select2.min.css', 'public/css/select2.min.css');

    //switchery
    mix.copy('bower_components/gentelella/vendors/switchery/dist/switchery.min.css', 'public/css/switchery.min.css');

    //starrr
    mix.copy('bower_components/gentelella/vendors/starrr/dist/starrr.css', 'public/css/starrr.css');

    //datetimepicker Bootstrap
    mix.copy('bower_components/gentelella/bower_components/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css', 'public/css/bootstrap-datetimepicker.min.css');

    //ion rangeSlider
    mix.copy('bower_components/gentelella/vendors/normalize-css/normalize.css', 'public/css/normalize.css');
    mix.copy('bower_components/gentelella/vendors/ion.rangeSlider/css/ion.rangeSlider.css', 'public/css/ion.rangeSlider.css');
    mix.copy('bower_components/gentelella/vendors/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css', 'public/css/ion.rangeSlider.skinFlat.css');
    mix.copy('bower_components/gentelella/vendors/cropper/dist/cropper.min.css', 'public/css/cropper.min.css');


    /****************/
    /* Copy Scripts */
    /****************/

    // Bootstrap
    mix.copy('bower_components/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js', 'public/js/bootstrap.min.js');

    // Bootstrap Progress bar
    mix.copy('bower_components/gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js', 'public/js/bootstrap-progressbar.min.js');

    // iCheck
    mix.copy('bower_components/gentelella/vendors/iCheck/icheck.min.js', 'public/js/icheck.min.js');

    // jQuery
    mix.copy('bower_components/gentelella/vendors/jquery/dist/jquery.min.js', 'public/js/jquery.min.js');

    // jQuery - Sparkline
    mix.copy('bower_components/gentelella/vendors/jquery-sparkline/dist/jquery.sparkline.min.js', 'public/js/jquery.sparkline.min.js');

    // Auto resize text area
    mix.copy('bower_components/gentelella/vendors/autosize/dist/autosize.min.js', 'public/js/autosize.min.js');

    // Chart.js
    mix.copy('bower_components/gentelella/vendors/Chart.js/dist/Chart.min.js', 'public/js/Chart.min.js');

    // jQuery Tags Input
    //mix.copy('bower_components/gentelella/vendors/jquery.tagsinput/dist/jquery.tagsinput.min.js', 'public/js/jquery.tagsinput.min.js');


    // bootstrap-wysiwyg
    mix.copy('bower_components/gentelella/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js', 'public/js/bootstrap-wysiwyg.min.js');

    // Dropzone
    mix.copy('bower_components/gentelella/vendors/dropzone/dist/min/dropzone.min.js', 'public/js/dropzone.min.js');

    // datatables bootstrap
    mix.copy('bower_components/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js', 'public/js/jquery.dataTables.min.js');

    // datatables bootstrap
    mix.copy('bower_components/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js', 'public/js/dataTables.bootstrap.min.js');

    //fastclick
    mix.copy('bower_components/gentelella/vendors/fastclick/lib/fastclick.js', 'public/js/fastclick.js');

    //nprogres
    mix.copy('bower_components/gentelella/vendors/nprogress/nprogress.js', 'public/js/nprogress.js');

    //gauge js
    mix.copy('bower_components/gentelella/vendors/gauge.js/dist/gauge.min.js', 'public/js/gauge.min.js');

    //skycons
    mix.copy('bower_components/gentelella/vendors/skycons/skycons.js', 'public/js/skycons.js');

    //flot
    mix.copy('bower_components/gentelella/vendors/Flot/jquery.flot.js', 'public/js/jquery.flot.js');
    mix.copy('bower_components/gentelella/vendors/Flot/jquery.flot.pie.js', 'public/js/jquery.flot.pie.js');
    mix.copy('bower_components/gentelella/vendors/Flot/jquery.flot.time.js', 'public/js/jquery.flot.time.js');
    mix.copy('bower_components/gentelella/vendors/Flot/jquery.flot.stack.js', 'public/js/jquery.flot.stack.js');
    mix.copy('bower_components/gentelella/vendors/Flot/jquery.flot.resize.js', 'public/js/jquery.flot.resize.js');

    //flot-plugin
    mix.copy('bower_components/gentelella/vendors/flot.orderbars/js/jquery.flot.orderBars.js', 'public/js/jquery.flot.orderBars.js');
    mix.copy('bower_components/gentelella/vendors/flot-spline/js/jquery.flot.spline.min.js', 'public/js/jquery.flot.spline.min.js');
    mix.copy('bower_components/gentelella/vendors/flot.curvedlines/curvedLines.js', 'public/js/curvedLines.js');

    //datejs
    mix.copy('bower_components/gentelella/vendors/DateJS/build/date.js', 'public/js/date.js');

    //bootstrap-daterangepicker
    mix.copy('bower_components/gentelella/vendors/moment/min/moment.min.js', 'public/js/moment.min.js');
    mix.copy('bower_components/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js', 'public/js/daterangepicker.js');

    //FullCalendar
    mix.copy('bower_components/gentelella/vendors/fullcalendar/dist/fullcalendar.min.js', 'public/js/fullcalendar.min.js');

    //echarts

    //prettyPrint
    mix.copy('bower_components/prettyPrint/prettyPrint.js', 'public/js/prettyPrint.js');

  //prettify
    mix.copy('bower_components/gentelella/vendors/google-code-prettify/src/prettify.js', 'public/js/prettify.js');

    //jqhotkeys
    mix.copy('bower_components/gentelella/vendors/jquery.hotkeys/jquery.hotkeys.js', 'public/js/jquery.hotkeys.js');

    //Switchery
    mix.copy('bower_components/gentelella/vendors/switchery/dist/switchery.min.js', 'public/js/switchery.min.js');

    //select2
    mix.copy('bower_components/gentelella/vendors/select2/dist/js/select2.full.min.js', 'public/js/select2.full.min.js');

    //parsley
    mix.copy('bower_components/gentelella/vendors/parsleyjs/dist/parsley.min.js', 'public/js/parsley.min.js');

    //autosize
    mix.copy('bower_components/gentelella/vendors/autosize/dist/autosize.min.js', 'public/js/autosize.min.js');

    //jquery autocomplete
    mix.copy('bower_components/gentelella/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js', 'public/js/jquery.autocomplete.min.js');

    //starr
    mix.copy('bower_components/gentelella/vendors/starrr/dist/starrr.js', 'public/js/starrr.js');

        // datetimepicker
        mix.copy('bower_components/gentelella/bower_components/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js', 'public/js/bootstrap-datetimepicker.min.js');

        // Ion.RangeSlider
        mix.copy('bower_components/gentelella/vendors/ion.rangeSlider/js/ion.rangeSlider.min.js', 'public/js/ion.rangeSlider.min.js');

        // jquery.inputmask
        mix.copy('bower_components/gentelella/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js', 'public/js/jquery.inputmask.bundle.min.js');

        // jQuery Knob
        mix.copy('bower_components/gentelella/vendors/jquery-knob/dist/jquery.knob.min.js', 'public/js/jquery.knob.min.js');

        // Cropper
        mix.copy('bower_components/gentelella/vendors/cropper/dist/cropper.min.js', 'public/js/cropper.min.js');


        // Gentelella
        mix.copy('bower_components/gentelella/build/js/custom.min.js', 'public/js/gentelella.min.js');


    /**************/
    /* Copy Fonts */
    /**************/

    // Bootstrap
    mix.copy('vendor/bower_components/gentelella/vendors/bootstrap/fonts/', 'public/fonts');

    // Font awesome
    mix.copy('vendor/bower_components/gentelella/vendors/font-awesome/fonts/', 'public/fonts');
});
