# Grabber
this library is a php web grabbing library for global and automated usage

**NOTE:** this library is under construction. do not use this yet


Sample Possible Scenario:

```phpil
$main = new WebCrawlingScenario();
$main->AddResource('web', new WebResource('http://www.allitebooks.com/'));
$main->AddResource('database', new DatabaseResource('myqsl', 'localhost', 'root', 'pass'));
$data = $main->AddAction(new InputInformation('web'))->run(); // html data
$extractor = new HtmlExtractor($data);
$data = $main->AddAction(new CssSelector('#menu-categories a', '[href]', $extractor))->run(); // array data of categories links
$data = $main->AddAction(new OutputInformation('database', $data, 'Categories', $map))->run(); // save categories links to database return list of steps
$main->AddActions($data);
$main->runThreads(10); // run steps, crawling each category page and its pages in 10 concurrent thread
```

