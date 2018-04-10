# Log-SQLite
Simple logging system using SQLite3

## Examples

```
include 'Log.php';

Log::add('Vamo testar isso');

//insert
//MSG,CAT,TIPO
Log::add('REGISTRO DE LOG DO SISTEMA ', 'CATEGORIA: ADMIN', 1);


//find id
$results = Log::find(1);
var_dump($results);

//delete id
$delete = Log::delete(15);
var_dump($delete);


//find all
$results2 = Log::findAll();
var_dump($results2);

//Where
$results2 = Log::findAll("cat='SYSTEM'");
var_dump($results2);
```


