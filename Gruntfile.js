module.exports = function(grunt){

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    // copy: {
    //   main: {
    //     expand: true,
    //     cwd: 'bower_components/fontawesome/fonts/',
    //     src: '**',
    //     dest: 'fonts/',
    //     flatten: true,
    //     filter: 'isFile',
    //   },
    // },

    cssmin: {
      options: {
        root: "./"
      },
      files: {
        src: [
            'style.css',
            'bower_components/bootstrap/dist/css/bootstrap.css',
            'bower_components/fontawesome/css/font-awesome.css'
        ],
        dest: 'ebas.min.css'
      }
    },

    uglify: {
      options: {},
      files: {
        src: [
          'bower_components/jquery/dist/jquery.js',
          'bower_components/bootstrap/dist/js/bootstrap.js',
          'bower_components/light-javascript-table-sorter/light-table-sorter.js',
          'bower_components/list.js/dist/list.js',
          'app.js'
        ],
        dest:  'ebas.min.js'
      }
    },

    watch:{
      files: [
        'app.js',
        'style.css'
      ],
      tasks: ['cssmin','uglify']
    }
  });

  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  // grunt.loadNpmTasks('grunt-php');

  grunt.registerTask('default', ['cssmin','uglify','watch']);
  // grunt.registerTask('server', ['php']);

};
