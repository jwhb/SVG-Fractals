SVG-Fractals
============

This was my submission to the german informatics competition "[BWINF](http://www.bundeswettbewerb-informatik.de/)" of 2013. 

With this generator you can let your webserver generate a vector image file ([SVG](http://en.wikipedia.org/wiki/SVG "SVG")) of a Sierpinski carpet.
It also lets you analyze an existing carpet file, as long as you specify a XML-compliant SVG file

> The Sierpinski carpet is a plane fractal first described by Wacław Sierpiński in 1916. The carpet is a generalization of the Cantor set to two dimensions (another is Cantor dust). Sierpiński demonstrated that this fractal is a universal curve, in that any possible one-dimensional graph, projected onto the two-dimensional plane, is homeomorphic to a subset of the Sierpinski carpet.
> 
> (Source: [Wikipedia](http://en.wikipedia.org/wiki/Sierpinski_carpet "Wikipedia"))

## Program design ##

This program is written in PHP and divided into an `Analyzer` class, a `Generator` class, a `Utils` class containing e.g. maths helper function, a template SVG file (`carpet.svg.php`) and finally a launcher file (`index.php`).

## Usage ##

To use this generator you have to copy the `app/` folder to your webserver's website folder and open  the web-address to the app folder. 

If you want to add more detail (more smaller squares) to an existing SVG file, upload the file to the app/ folder to be able to choose it on the launcher.

Basically you don't need to adjust the render/display size parameters, the most important parameter is 'Stages to add'. This is the number of iterations that the generator adds squares of the iteration's square size.
