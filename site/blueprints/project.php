<?php if(!defined('KIRBY')) exit ?>

title: Project
pages: false
files: true
fields:
  title:
    label: Title
    type:  text
    width: 1/2
  featuredimage:
    label: Featured image
    type: image
    required: true
    width: 1/2
  text:
    label: Description for SEO
    type:  textarea
  category:
    label: Category
    type: select 
    options: field
    field:
      page: ../
      name: categories
  gallery:
    label: Images
    type: gallery
