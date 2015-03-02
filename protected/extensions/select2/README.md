Select2
=======

Select2 is a jQuery-based replacement for select boxes. It supports searching,
remote data sets, and pagination of results.

To get started, checkout examples and documentation at
http://select2.github.io/select2

Use cases
---------

* Enhancing native selects with search.
* Enhancing native selects with a better multi-select interface.
* Loading data from JavaScript: easily load items via ajax and have them searchable.
* Nesting optgroups: native selects only support one level of nested. Select2 does not have this restriction.
* Tagging: ability to add new items on the fly.
* Working with large, remote datasets: ability to partially load a dataset based on the search term.
* Paging of large datasets: easy support for loading more pages when the results are scrolled to the end.
* Templating: support for custom rendering of results and selections.

Browser compatibility
---------------------
* IE 8+
* Chrome 8+
* Firefox 10+
* Safari 3+
* Opera 10.6+

Usage
-----
You can source Select2 directly from a CDN like [JSDliver][jsdelivr] or
[CDNJS][cdnjs], [download it from this GitHub repo][tags], or use one of
the integrations below.

Integrations
------------

* [Wicket-Select2][wicket-select2] (Java / [Apache Wicket][wicket])
* [select2-rails][select2-rails] (Ruby on Rails)
* [AngularUI][angularui-select] ([AngularJS][angularjs])
* [Django][django-select2]
* [Symfony][symfony-select2]
* [Symfony2][symfony2-select2]
* [Bootstrap 2][bootstrap2-select2] and [Bootstrap 3][bootstrap3-select2]
  (CSS skins)
* [Meteor][meteor-select2] ([Bootstrap 3 skin][meteor-select2-bootstrap3])
* [Meteor][meteor-select2-alt]
* [Yii 2.x][yii2-select2]
* [Yii 1.x][yii-select2]
* [AtmosphereJS][atmospherejs-select2]

Internationalization (i18n)
---------------------------

Select2 supports multiple languages by simply including the right language JS
file (`dist/js/i18n/it.js`, `dist/js/i18n/nl.js`, etc.) after
`dist/js/select2.js`.

Missing a language? Just copy `src/js/select2/i18n/en.js`, translate it, and
make a pull request back to Select2 here on GitHub.

Documentation
-------------

The documentation for Select2 is available
[through GitHub Pages][documentation] and is located within this repository
in the [docs folder][documentation-folder].

Community
---------

### Bug tracker

Have a bug? Please create an issue here on GitHub!

https://github.com/select2/select2/issues

### Mailing list

Have a question? Ask on our mailing list!

select2@googlegroups.com

https://groups.google.com/d/forum/select2

### IRC channel

Need help implementing Select2 in your project? Ask in our IRC channel!

**Network:** [Freenode][freenode] (`chat.freenode.net`)

**Channel:** `#select2`

**Web access:** https://webchat.freenode.net/?channels=select2

Copyright and license
---------------------
The license is available within the repository in the [LICENSE][license] file.

[angularjs]: https://angularjs.org/
[angularui-select]: http://angular-ui.github.io/#ui-select
[atmospherejs-select2]: https://atmospherejs.com/package/jquery-select2
[bootstrap2-select2]: https://github.com/t0m/select2-bootstrap-css
[bootstrap3-select2]: https://github.com/t0m/select2-bootstrap-css/tree/bootstrap3
[cdnjs]: http://www.cdnjs.com/libraries/select2
[django-select2]: https://github.com/applegrew/django-select2
[documentation]: https://select2.github.io/select2/
[documentation-folder]: https://github.com/select2/select2/tree/master/docs
[freenode]: https://freenode.net/
[jsdelivr]: http://www.jsdelivr.com/#!select2
[license]: LICENSE.md
[meteor-select2]: https://github.com/nate-strauser/meteor-select2
[meteor-select2-alt]: https://jquery-select2.meteor.com
[meteor-select2-bootstrap3]: https://github.com/esperadomedia/meteor-select2-bootstrap3-css/
[select2-rails]: https://github.com/argerim/select2-rails
[symfony-select2]: https://github.com/19Gerhard85/sfSelect2WidgetsPlugin
[symfony2-select2]: https://github.com/avocode/FormExtensions
[tags]: https://github.com/select2/select2/tags
[wicket]: http://wicket.apache.org
[wicket-select2]: https://github.com/ivaynberg/wicket-select2
[yii-select2]: https://github.com/tonybolzan/yii-select2
[yii2-select2]: http://demos.krajee.com/widgets#select2
