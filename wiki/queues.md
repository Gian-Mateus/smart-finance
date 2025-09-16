Definindo fila:

Segundo a documentação do laravel há a necessidade de ter uma configuração de conexão com o redis para uso em filas, mas o único exeplo dado é esse mais a baixo:
`
'redis' => [
    'driver' => 'redis',
    'connection' => env('REDIS_QUEUE_CONNECTION', 'default'),
    'queue' => env('REDIS_QUEUE', 'default'),
    'retry_after' => env('REDIS_QUEUE_RETRY_AFTER', 90),
    'block_for' => 5, // O exemplo está no trecho que fala sobre bloqueio da execução da queue, há outro exemplo similar um pouco mais acima na documentação
    'after_commit' => false,
],
`

Não é necessário uma outra classe além da job para executar as tarefas em filas.