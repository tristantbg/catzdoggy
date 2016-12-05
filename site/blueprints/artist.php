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
    width: 1/2
  featuredimage:
    label: Featured image
    type: image
    help: Required to display Artist
    width: 1/2
  template:
    label: Template
    type: select
    required: true
    width: 1/2
    default: all
    options:
      all: All projects
      solo: One project
      categories: Categories
  soloproject:
    label: Selected project
    type: quickselect
    options: grandchildren
    sort: asc
    text: '{{title}} ({{uri}})'
    placeholder: Choose a project...
    help: Only for "One project" template
    width: 1/2
  text:
    label: Description for SEO
    type:  textarea
  clients:
    label: Clients
    type: list
    placeholder: Add a new client
    width: 1/2