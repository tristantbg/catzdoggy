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
        sort: asc
        query:
          page: artists
          fetch: index
          text: '{{title}} ({{uri}})'
          value: '{{uri}}'
        placeholder: Choose a project...
        required: true
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