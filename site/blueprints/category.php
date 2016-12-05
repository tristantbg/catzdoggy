<?php if(!defined('KIRBY')) exit ?>

title: Category
pages:
  template:
    - project
files: true
fields:
  titleSettings:
    label: Category Settings
    type: headline
  title:
    label: Title
    type:  text
    width: 1/2
  featuredimage:
    label: Featured image
    type: image
    required: true
    width: 1/2
