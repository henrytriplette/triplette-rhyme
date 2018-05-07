## Windows: Load large txt into MySql

From phpmyadmin -> Query SQL
Insert the following code:

```
LOAD DATA INFILE 'D:\\Sites\\triplette-rhyme\\_sources\\660000_parole_italiane.txt' INTO TABLE `dictionary_ita`
```
