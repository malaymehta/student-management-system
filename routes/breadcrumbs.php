<?php

//Home
Breadcrumbs::register('home', function($breadcrumbs){
    $breadcrumbs->push('Home', route('home'));
});

// Home > Academic Year
Breadcrumbs::register('AcademicYear', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Academic Year', route('academic-year.index'));
});

// Home > Academic Year Update/Store
Breadcrumbs::register('AcademicYearStore', function($breadcrumbs)
{
    $breadcrumbs->parent('AcademicYear');
    $breadcrumbs->push('Add Academic Year', route('academic-year.create'));
})
?>