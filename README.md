# INVO Application

[Phalcon][1] is a web framework delivered as a C extension providing high
performance and lower resource consumption.

This is a sample application for the Phalcon PHP Framework. We expect to
implement as many features as possible to showcase the framework and its
potential.

Please write us if you have any feedback.

Thanks.

## NOTE

The master branch will always contain the latest stable version. If you wish
to check older versions or newer ones currently under development, please
switch to the relevant branch.

## Get Started

### Requirements

* PHP >= 7.2
* [Apache][2] Web Server with [mod_rewrite][3] enabled or [Nginx][4] Web Server
* Latest stable [Phalcon Framework release][5] extension enabled
* [MySQL][6] >= 5.5

### Installation

1. Copy project to local environment - `git clone git@github.com:phalcon/invo.git`
2. Copy file `cp .env.example .env`
3. Edit .env file with your DB connection information
4. Run DB migrations `vendor/bin/phalcon-migrations migration run --config=migrations.php`

## Contributing

See [CONTRIBUTING.md][7]

## Sponsors

Become a sponsor and get your logo on our README on Github with a link to your site. [[Become a sponsor](https://opencollective.com/phalcon#sponsor)]

<a href="https://opencollective.com/phalcon/#contributors">
<img src="https://opencollective.com/phalcon/tiers/sponsors.svg?avatarHeight=48&width=800">
</a>

## Backers

Support us with a monthly donation and help us continue our activities. [[Become a backer](https://opencollective.com/phalcon#backer)]

<a href="https://opencollective.com/phalcon/#contributors">
<img src="https://opencollective.com/phalcon/tiers/backers.svg?avatarHeight=48&width=800&height=200">
</a>

## License

Invo is open-sourced software licensed under the [New BSD License][8]. © Phalcon Framework Team and contributors

[1]: https://phalcon.io/
[2]: http://httpd.apache.org/
[3]: http://httpd.apache.org/docs/current/mod/mod_rewrite.html
[4]: http://nginx.org/
[5]: https://github.com/phalcon/cphalcon/releases
[6]: https://www.mysql.com/
[7]: https://github.com/phalcon/invo/blob/master/CONTRIBUTING.md
[8]: https://github.com/phalcon/invo/blob/master/docs/LICENSE.md
