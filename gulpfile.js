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

    // bootstrap-daterangepicker
    mix.copy('bower_components/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js', 'public/js/daterangepicker.js');

    // bootstrap-wysiwyg
    mix.copy('bower_components/gentelella/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js', 'public/js/bootstrap-wysiwyg.min.js');

    // Dropzone
    mix.copy('bower_components/gentelella/vendors/dropzone/dist/min/dropzone.min.js', 'public/js/dropzone.min.js');

    // datatables bootstrap
    mix.copy('bower_components/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js', 'public/js/jquery.dataTables.min.js');

    // datatables bootstrap
    mix.copy('bower_components/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js', 'public/js/dataTables.bootstrap.min.js');

//FullCalendar
//echarts

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
