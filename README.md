# DNAFactory - PageSpeed
Speed up your Magento 2 and improve its Google PageSpeed score with some optimizations.
___

### requirejs deferral options
Allows to defer all requirejs module loadings, increasing TBT score.

When enabled you can also disallow these feature for specific layouts, by simply including this *handle* in yuour xml:
```xml
<update handle="no_requirejs_deferral" />
```