## ApiDoc文档生成注释文件归档工具

### 使用

- 安装

    1. 项目composer文件中添加仓库源
        ```
        {
            ...
            "repositories": [
                {
                    "type": "vcs",
                    "url": "git@gitee.com:leyao_sz/apidoc.git"
                }
            ]
            ...
        }
        ```
    2. 执行 `compoesr require leyao/apidoc --dev`
    
- 使用
    1. 发布配置文件 `php artisan vendor:publish --tag=config --provider="Leyao\ApiDoc\ServiceProvider"`
    2. 编辑 `config/apidoc.php` 相关参数
    3. 执行 `php artisan vendor:publish --tag=ApiDoc` 即可将制定的文件全部归档至配置的文件夹下

### 开发
若需在开发包中使用, 则可以在对应开发包内依赖本包, 并且在对应的 `ServiceProvider` 注册需要发布的文档注释文件, 如:

```php
#MyServiceProvider.php
<?php
use Illuminate\Support\ServiceProvider;
use Leyao\ApiDoc\ServiceProvider as ApiServiceProvider;

class MyServiceProvider extends ServiceProvider
{
	public function boot()
	{
		if (env('APP_ENV') !== 'production') {
			$this->publishes([
				__DIR__ . '/Http/Sauce/Controllers' => base_path(config('apidoc.documents_generate_dir'). '/MyPackage')
			], ApiServiceProvider::API_DOC_TAG);
		}
	}

	public function register()
	{
	}
}

```