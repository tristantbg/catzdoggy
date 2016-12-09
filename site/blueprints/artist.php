<?php if(!defined('KIRBY')) exit ?>

title: Artist
pages:
  template:
    - category
files: true
fields:
  titleSettings:
    label: Artist Settings
    type: headline
  title:
    label: Name
    type:  text
  featuredimage:
    label: Featured image
    type: image
    help: Required to display Artist
    width: 1/2
  pagetemplate:
    label: Template
    type: select
    required: true
    width: 1/2
    default: all
    options:
      all: All projects
      portfolio: Portfolio
      categories: Categories
  text:
    label: Description for SEO
    type:  textarea
  clients:
    label: Clients
    type: structure
    style: table
    fields:
      client:
        label: Name
        type: text
      clientimage:
        label: Image
        type: image