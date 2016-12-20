<?php if(!defined('KIRBY')) exit ?>

title: Video Project
pages: false
files: true
fields:
  titleSettings:
    label: Video Project Settings
    type: headline
  title:
    label: Title
    type:  text
    width: 1/2
  featuredimage:
    label: Featured image
    type: image
    help: Required to display Project
    width: 1/2
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
    min: 0
    max: 8
    required: true
    width: 1/2
  text:
    label: Description for SEO
    type:  textarea
  videofile:
    label: Video File
    type: select
    options: files
    help: MP4 file
    width: 1/2
  videourl:
    label: Video ID
    type: text
    help: Vimeo or Youtube ID
    width: 1/2
  prevnext: prevnext
