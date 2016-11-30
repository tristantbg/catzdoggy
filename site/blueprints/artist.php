<?php if(!defined('KIRBY')) exit ?>

title: Artist
pages:
  template:
    - project
files: true
fields:
  title:
    label: Name
    type:  text
    width: 1/2
  featuredimage:
    label: Featured image
    type: image
    required: true
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
    options: children
    text: '{{title}}'
    placeholder: Choose a project...
    help: Only for "One project" template
    width: 1/2
  text:
    label: Description for SEO
    type:  textarea
  categories:
    label: Categories
    type: tags
    width: 1/2
  clients:
    label: Clients
    type: list
    placeholder: Add a new client
    width: 1/2