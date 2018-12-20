# State of Black Asheville: Wordpress

As part of the 2018 Code for America Community Fellowship, we created a Wordpress website that acts has a repository for all of the information and research we have conducted for this project.

The website also integrates with the State of Black Asheville data visualization library located here:

https://github.com/stateofblackasheville/soba-visualization

This guide will provide information on installing the State of Black Asheville platform, and entering and updating content within the platform.

# Installation

While you can install the State of Black Asheville website on any PHP server, we recommend hsting the through [Pantheon](https://pantheon.io/), which provides developer tools to manage a dev, test, and live environment for your application code and database.

Right now, you can access all of the application code in this repository. We are working through setting up a skeleton database that will contain example content and the bare minimum needed to deploy a new installation of the website. Right now this is not included in this repository, but please let us know if you'd like to re-deploy this platform, and we can work with you to get the required database content and configurations to you.

# Plugins

The state of Black Asheville relies on just a few plugins to handle most of its operations. The most critical ones are below.

##Advanced Custom Fields Pro
Used to define fields on various types of content. We also use the flex field to build out pages in a structured way.

##Custom Post Type UI
Used to define custom post types that are used throughout the website.

##ACF: Better Search
Used to allow searching of ACF fields (for archives).

_Other plugins are included, but their usage is fairly self-explanatory_

# Content Types

##Visualization
Visualizations are a 

##Student Paper

##Page
###Templates

##Cultural Items

## Get some data
It will probably be easier to work through this with some data. Make a Google Docs spreadsheet with your information, like:

https://docs.google.com/spreadsheets/d/1_oMYZp3DnkDUzp4qC31q5KisnXU0YnOzTg_gwi2XbME

## Install React
First things first - make sure you have React and React DOM installed on your site

```html
<script type='text/javascript' src='https://unpkg.com/react@16/umd/react.production.min.js?v=1.1.2'></script>
<script type='text/javascript' src='https://unpkg.com/react-dom@16.6.0/umd/react-dom.production.min.js'></script>
```

## Install soba-visualization
Now, make sure you have the soba-visualiztion library acticated on your site - you can use unpkg.com to drop it on the page! 

Note - this also includes some jQuery we use to bring HTML markup into React

```html
<script type='text/javascript' src='https://unpkg.com/soba-visualization@latest/umd/soba-visualization.min.js?v=1.1.2'></script>
<script type='text/javascript' src='https://www.stateofblackasheville.com/wp-content/themes/sage-8.5.4/dist/scripts/visualization.js?v=1.1.2'></script>
```

## Finally, add some visualizations anywhere on the page

```html
<div 
	class='soba-visualization' 
	data-title='Spreadsheet Demo'
	data-spreadsheetId='1_oMYZp3DnkDUzp4qC31q5KisnXU0YnOzTg_gwi2XbME'
	data-charttype='bar'  
/>
```

## That's it! 

# Options

## Common
Used for both Google Spreadsheet and GraphQL Modes

- **title** *(String)* :  
Title of the Chart

- **chartType** *(Array[String])* :  
['Line', 'Bar'] - Which chart types to display. 

- **showChartTypeSelect:** *true/false* 
Whether to show the chart-type select dropdown

- **datasetLabels**: 

- **labelX**: 

- **labelY**: 

- **summaryText**: 

## Google Spreadsheet
- **spreadsheetId:** 
ID of the Google Spreadsheet, from the URL:
**1_oMYZp3DnkDUzp4qC31q5KisnXU0YnOzTg_gwi2XbME**

- **spreadsheetChartColumns:** ['A','B'] Columns to display (defaults to showing all) 

## GraphQL
- **dataset:** 

- **count:**

- **byDate:**

- **groupBy:**

- **filters:**

# Demo
