<?php

class MyQueue {

  public function fire($job, $data){

  }

  function fetchDataSourceColumns($job, $data)
  {
    $config = DataSourceConfig::find($data['config_id']);
    $datasource = DataSource::find($config->datasource_id);

    $csv = array_map('str_getcsv', file($datasource->url));

    $config->datasource_columns = serialize($csv[0]);
    $config->config_status = 2;
    $config->save();

    $job->delete();

  }

}