<?php

class Define_Schemas {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
  {
    Schema::create('users', function($t) {
      $t->integer('ruid')->unsigned();
      $t->string('netid')->unique();
      $t->string('email')->unique();
      $t->string('password');
      $t->string('name');

      $t->primary('ruid');
    });

    Schema::create('students', function($t) {
      $t->increments('id');
      $t->string('grad_semester');
      $t->integer('grad_year')->unsigned();
      $t->integer('user_id')->unsigned();
      $t->foreign('user_id')->references('ruid')->on('users')->on_delete('cascade');
    });

    Schema::create('instructors', function($t) {
      $t->increments('id');
      $t->integer('user_id')->unsigned();
      $t->foreign('user_id')->references('ruid')->on('users')->on_delete('cascade');
    });

    Schema::create('majors', function($t) {
      $t->increments('id');
      $t->string('name');
    });

    Schema::create('major_student', function($t) {
      $t->increments('id');
      $t->integer('major_id')->unsigned();
      $t->foreign('major_id')->references('id')->on('majors')->on_delete('cascade');
      $t->integer('student_id')->unsigned();
      $t->foreign('student_id')->references('id')->on('majors')->on_delete('cascade');
    });

    Schema::create('courses', function($t) {
      $t->increments('id');
      $t->string('name');
      $t->integer('school_num')->unsigned();
      $t->integer('dept_num')->unsigned();
      $t->integer('course_num')->unsigned();
      $t->string('prereqs');
    });

    Schema::create('course_student', function($t) {
      $t->increments('id');
      $t->integer('course_id')->unsigned();
      $t->foreign('course_id')->references('id')->on('courses')->on_delete('cascade');
      $t->integer('student_id')->unsigned();
      $t->foreign('student_id')->references('id')->on('students')->on_delete('cascade');
    });

    Schema::create('sects', function($t) {
      $t->increments('id');
      $t->integer('num_students')->unsigned()->default(0);
      $t->integer('capacity')->unsigned();
      $t->string('course_index');
      $t->integer('course_id')->unsigned();
      $t->foreign('course_id')->references('id')->on('courses')->on_delete('cascade');
      $t->integer('instructor_id')->unsigned();
      $t->foreign('instructor_id')->references('id')->on('instructors')->on_delete('cascade');
    });

    Schema::create('reqs', function($t) {
      $t->increments('id');
      $t->string('comment')->default('');
      $t->string('status')->default('pending');
      $t->integer('priority')->default(5);
      $t->boolean('required')->default(false);
      $t->integer('sect_id')->unsigned();
      $t->foreign('sect_id')->references('id')->on('sects')->on_delete('cascade');
      $t->integer('student_id')->unsigned();
      $t->foreign('student_id')->references('id')->on('students')->on_delete('cascade');
      $t->unique(array('student_id', 'sect_id'));
    });

    Schema::create('permissionnumbers', function($t) {
      $t->increments('id');
      $t->string('permission_code');
      $t->integer('student_id')->unsigned()->nullable();
      $t->foreign('student_id')->references('id')->on('students')->on_delete('cascade');
      $t->integer('sect_id')->unsigned();
      $t->foreign('sect_id')->references('id')->on('sects')->on_delete('cascade');
    });

    Schema::create('emails', function($t) {
      $t->increments('id');
      $t->string('to');
      $t->string('from');
      $t->string('subject')->default('');
      $t->string('body')->default('');
    });

    Schema::create('prevcourses', function($t) {
      $t->increments('id');
      $t->string('name');
      $t->integer('school_num')->unsigned();
      $t->integer('dept_num')->unsigned();
      $t->integer('course_num')->unsigned();
      $t->string('prereqs');
    });

    Schema::create('prevcourse_student', function($t) {
      $t->increments('id');
      $t->integer('prevcourse_id')->unsigned();
      $t->foreign('prevcourse_id')->references('id')->on('prevcourses')->on_delete('cascade');
      $t->integer('student_id')->unsigned();
      $t->foreign('student_id')->references('id')->on('students')->on_delete('cascade');
    });
	}


	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
  {
     Schema::drop('emails');
     Schema::drop('permissionnumbers');
     Schema::drop('reqs');
     Schema::drop('sects');
     Schema::drop('course_student');
     Schema::drop('courses');
     Schema::drop('major_student');
     Schema::drop('majors');
     Schema::drop('instructors');
     Schema::drop('students');
     Schema::drop('users');

     Schema::drop('prevcourses');
     Schema::drop('prevcourse_student');
  }

}
