<?php if(!defined('KIRBY')) exit ?>

title: Home
pages: false
files: true
fields:
  title:
    label: Title
    type:  text
  globalorder:
    label: Global order
    type: structure
    style: table
    fields:
      project:
        label: Project
        type: quickselect
        options: query
        query:
          page: artists
          fetch: grandchildren
          text: '{{title}} ({{uri}})'
        placeholder: Choose a project...
        required: true