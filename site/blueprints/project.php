<?php if(!defined('KIRBY')) exit ?>

title: Project
pages: false
files: true
fields:
  titleSettings:
    label: Project Settings
    type: headline
  title:
    label: Title
    type:  text
    width: 1/2
  featuredimage:
    label: Featured image
    type: image
    help: Required to display Project
    width: 1/4
  id:
    label: Order ID
    type: number
    default: 0
    required: true
    width: 1/4
  gridwidth:
    label: Grid width
    type: number
    default: 4
    min: 1
    max: 8
    required: true
    width: 1/2
  gridoffset:
    label: Grid offset
    type: number
    default: 0
    min: -8
    max: 8
    required: true
    width: 1/2
  text:
    label: Description for SEO
    type:  textarea
  gallery:
    label: Images
    type: gallery
