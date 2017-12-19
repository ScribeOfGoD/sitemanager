# sitemanager

A CLI local site management written in PHP.

## Structure

```
bin/
src/
tests/
vendor/
```

## Install

Via Composer

``` bash
$ composer global require undeadyetii/sitemanager
```

## Usage

**Adding a new site**

```bash
sitemanager add {{site_name}}
```

**Removing a site**

```bash
sitemanager remove {{site_name}}
```

**Specifying a custom hosts/vhosts file**

```bash
sitemanager {{command}} --vhosts path/to/vhosts.conf
sitemanager {{command}} --hosts path/to/hosts
```

**For more information on a command**

```bash
sitemanager add --help
sitemanager remove --help
```

## Testing

``` bash
$ composer test
```

## Credits

- [undeadyetii][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

[link-packagist]: https://packagist.org/packages/undeadyetii/sitemanager
[link-author]: https://github.com/undeadyetii
[link-contributors]: ../../contributors
