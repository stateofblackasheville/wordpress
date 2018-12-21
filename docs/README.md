# State of Black Asheville: Wordpress

As part of the 2018 Code for America Community Fellowship, we created a Wordpress website that acts has a repository for all of the information and research we have conducted for this project.

The website also integrates with the State of Black Asheville data visualization library located here:

[https://github.com/stateofblackasheville/soba-visualization](https://github.com/stateofblackasheville/soba-visualization)

This guide will provide information on installing the State of Black Asheville platform, and entering and updating content within the platform.

# Installation

While you can install the State of Black Asheville website on any PHP server, we recommend hsting the through [Pantheon](https://pantheon.io/), which provides developer tools to manage a dev, test, and live environment for your application code and database.

Right now, you can access all of the application code in this repository. We are working through setting up a skeleton database that will contain example content and the bare minimum needed to deploy a new installation of the website. Right now this is not included in this repository, but please let us know if you'd like to re-deploy this platform, and we can work with you to get the required database content and configurations to you.

# Plugins

The state of Black Asheville relies on just a few plugins to handle most of its operations. The most critical ones are below.

## Advanced Custom Fields Pro
Used to define fields on various types of content. We also use the flex field to build out pages in a structured way.

## Custom Post Type UI
Used to define custom post types that are used throughout the website.

## ACF: Better Search
Used to allow searching of ACF fields (for archives).

_Other plugins are included, but their usage is fairly self-explanatory_

# Content Types

## Visualization

[http://stateofblackasheville.com/visualizations/](http://stateofblackasheville.com/visualizations/)

"Visualizations" in the Wordpress system are a visual representation of the data that is collection for the purposes of the project.

Let's use an example to show how visualizations work!

Have a look at [this visualization](http://stateofblackasheville.com/visualization/asheville-city-schools-2016-2017-school-year-white-and-black-demographics/).

This visualization is generated from a globally accessible [Google spreadsheet](https://docs.google.com/spreadsheets/d/1IbHdl_O1XC0dOWy0En4pvLePZrchTshHti3g1FS7PRQ/edit).

Let's take a look at the "anatomy" of a visualization content type on the platform:

### Visualization Content Type Fields

Visualizations are like normal posts — they receive a title, body, and can have tags and categories.

They also have a few fields that make them unique.

#### Document Reference & Page Number

This is used to tie a visualization to a document in the platform, like a student paper. This is optional.

If you create a document reference, you can also refer to the page number in case you want to inform the user what specific page within the document that the visualization refers to.

#### Visualization Title

This field is optional, but can be used as a separate title if the post title is not descriptive enough.

#### Data Source Reference/ID

Looking at our current example:

[https://docs.google.com/spreadsheets/d/1IbHdl_O1XC0dOWy0En4pvLePZrchTshHti3g1FS7PRQ/edit](https://docs.google.com/spreadsheets/d/1IbHdl_O1XC0dOWy0En4pvLePZrchTshHti3g1FS7PRQ/edit)

This field contains just the unique ID part of the URL, so:

`1IbHdl_O1XC0dOWy0En4pvLePZrchTshHti3g1FS7PR`

This is required for any visualization that is powered by Google Spreadsheets.

#### Data Source Reference/ID

Let's say you have a Google sheet that has multiple tabs. You can use this field to specify a sheet or sheet range that you wish to visualize, like so:

`SheetName!A1:Z12`

This field is optional, and only necessary if you'd like to reference a specific range or tab within a spreadsheet.

#### Chart Type

Select the default chart type from the following options:

* Line
* Bar
* Pie

_Note: The pie chart functionality does not operate currently, but this feature is in the works!_

#### Show Chart Select?

Toggle on/off depending on whether you want the user to be able to select the chart type.

#### Spreadsheet Chart Columns

This is an array of strings that specifies what spreadsheet columns to compare the values from. Column "A" always spans across the X axis, and is typically the year or category within which to group the values in the following columns.

In our [example](https://docs.google.com/spreadsheets/d/1IbHdl_O1XC0dOWy0En4pvLePZrchTshHti3g1FS7PRQ/edit#gid=0), column "A" is the year, whereas column "B" contains the values in the "Black" column, and column "C" contains the values in the "White" column.

So in this field, we specify the array as:

`["b", "c"]`

To specify that we want to compare the values in column B with those in column C, grouped by the year values in column A.

#### Summary Text

Seeing trends over time is great, but we can also generate point in time statistics by passing in an array of strings.

In our [example](http://stateofblackasheville.com/visualization/asheville-city-schools-2016-2017-school-year-white-and-black-demographics/), we see the following Statement:

4,421 total students
63.11% White — 2790 total
20.33% Black — 899 total

With a dropdown generated from column A that will change the numbers to reflect those of each year when changed.

We create this text with these dynamic figures by passing in the following array of strings into this field:

`["(D) total students", "(F) White — (C) total", "(E) Black — (B) total"]`

The parentheticals in each string equate to a column in the referenced spreadsheet. Each time the year is switched (it can also be a non-year categorical grouping), the values change to reflect each column's value that corresponds with the row of the selected year.

Each array item will create a new line. 

This field is optional, and if it is not populated, the dropdown that pulls the values from column A will not generate.

#### Data Sources

You can set up data sources in two different ways:

* By selecting another visualizations to pull in its sources, which can save time in cases where you have multiple visualizations from the same source.
* By manually inputting a list of sources, which can contain an optional source title, a source link, and a source file (if applicable).

You can use both of these sourcing options in conjunction if, for example, a visualization has most of the sources of another, plus one additional source.

_Note: Right now, for simplicity, sources are attached directly to visualizations, however we have considered breaking them out into their own content type so they can be re-used. For now, if you have a set of sources you wish to use over time, we recommend you create a visualization specifically for the purposes of sources, and relate other visualizations to it._

#### Other Fields/Cleanup

We have some cleanup to handle for the other fields. However you can also optionally embed visualizations using the "Embed" field.

Please refer to the visualization repo to learn how to create visualization markup:

[https://github.com/stateofblackasheville/wordpress/tree/master/docs](https://github.com/stateofblackasheville/wordpress/tree/master/docs)

The visualization fields above, in essence, generate the markup for you (using the same HTML attributes you'll find in the above repo). If you're not pulling data from Google sheets, however, or you have another type of visualization you wish to embed, you can use the "embed" field to generate the visualization in a more flexible way.

## Student Papers

[http://stateofblackasheville.com/student-papers/](http://stateofblackasheville.com/student-papers/)

The State of Black Asheville began as a student research project at the University of North Carolina at Asheville, so a big component of the platform is cataloging the student research papers that were produced over the past 10 years, taking the visualizations therein, and making them dynamic.

Student papers operate the same as posts in the Wordpress platform, but like visualizations, they have a few additional fields that are specific to their usage.

Let's look at an example to outline the fields within each student research paper:

[http://stateofblackasheville.com/student_paper/asheville-city-schools-safe-schools/](http://stateofblackasheville.com/student_paper/asheville-city-schools-safe-schools/)

At the very basics, the student research papers should have a title, body, and file (of the paper itself).

Additionally, papers should contain the following fields.

### Student Paper Fields

#### Document Index URL

The document index indicates where each visualization lives within each paper, including the title of the visualization, the source, and the page number on which it is located. There is a process to indexing the student papers, outlined here:

[http://stateofblackasheville.com/how-to-index/](http://stateofblackasheville.com/how-to-index/)

For this paper, the index is located in a Google document, here:

[https://docs.google.com/document/d/15u3WXl2-v_tjJ_AzQkN-hjs4HwOh8w9aX43tWkKV5qs/edit?ts=5bb23e9c#](https://docs.google.com/document/d/15u3WXl2-v_tjJ_AzQkN-hjs4HwOh8w9aX43tWkKV5qs/edit?ts=5bb23e9c#)

#### Sources

Like visualizations, student papers also can have a list of sources.

## Page

Pages are used to house and display general content within the system.

They are used for things like general informational pages (like about us, etc.) as well as more involved data pages like the data focuses.

All pages can be constructed using the normal Wordpress description, or using the "Flexible Content" field that is shown on each page.

### Templates

#### Data Focus
This page type will do a few things:

* It will automatically render child/parent pages in a submenu system.
* It will create a scrollspy navigation that allows users to navigate to page sections more easily.

#### Borderless Section Page
If you want to feature a nice big image at the top, then this template is for you.

### Flexible Content Field
This field is used to configure page content in a structured way, which allows features like the scrollspy, which keeps large pages with a lot of dynamic content properly organized.

The flexible content field is arranged in rows, then columns, using a grid system. 

#### Type: Custom

_INFO NEEDED_

#### Type: Relational Dynamic

_INFO NEEDED_

#### Type: Relational Curated

_INFO NEEDED_

#### Type: Content Totals

_INFO NEEDED_

#### Type: Tabs

_Note: Since we published this platform, the Gutenburg feature was released for Wordpress. Our goal will be to eventually roll this flexible content field into the Gutenburg functionality for ease of use._

#### Section Settings

_INFO NEEDED_

#### Section Content

_INFO NEEDED_

#### Background Options

_INFO NEEDED_

#### Color & Sizing Options

_INFO NEEDED_

#### Header Options

_INFO NEEDED_

#### Use Content Image

_INFO NEEDED_

#### Additional Classes

_INFO NEEDED_

### Sidebar Content

The sidebar content, if populated, will show up within the sidebar of the page. 

The sidebar content uses the same flexible content field as the main content, however its content is always stacked.

## Cultural Items

_INFO NEEDED_


