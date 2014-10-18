module.exports = function(grunt){

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    uglify: {
      js: {
        files: {
          'ebas.min.js': ['ebas.js']
        }
      }
    },
    cssmin: {
      css: {
        src: 'ebas.css',
        dest: 'ebas.min.css'
      }
    },
    watch:{
      files: ['ebas.js','ebas.css'],
      tasks: ['cssmin','uglify']
    }
  });

  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.registerTask('default', ['cssmin','watch','uglify']);

};
