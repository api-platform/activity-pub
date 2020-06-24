# API Platform ActivityPub

⚠️ This project is highly experimental, it isn't suitable for production yet ⚠️

API Platform ActivityPub is a bundle for [the API Platform framework](https://api-platform.com) and
[Symfony](https://symfony.com) providing support for [the ActivityPub protocol](https://www.w3.org/TR/activitypub/) and
for [the ActivityStreams vocabulary](https://www.w3.org/TR/activitystreams-core/).

> The ActivityPub protocol is a decentralized social networking protocol.
> It provides a client to server API for creating, updating and deleting content, as well as a federated server to
> server API for delivering notifications and content.

API Platform ActivityPub allows to easily add support for ActivityPub to new or existing API Platform projects,
while still being able to benefit from all API Platform features (yes, including [Mercure](https://mercure.rocks),
[Vulcain](https://vulcain.rocks) and GraphQL!)

## Install

## Install API Platform or Symfony

If it's not already done!

### Install the Bundle

    composer require api-platform/activity-pub

### Generate the ActivityPub Entities

Install [API Platform Schema Generator](https://api-platform.com/docs/schema-generator/):

    composer require --dev api-platform/schema-generator

Alternatively, you can download the PHAR version.

⚠️ Currently, [this development version](https://github.com/api-platform/schema-generator/pull/204) must be used to generate the schema

Then generate the entities:

    ../schema-generator/bin/schema generate src vendor/api-platform/activity-pub/build/schema.yaml

If you want to tweak the generated files, copy and adapt the provided configuration file.
The generation is a one time operation, then you can edit the entities to fit your need and remove `api-platform/schema-generator`.

### Configure Doctrine, API Platform and Symfony

See the test configuration in [`tests/app/index.php`](tests/app/index.php)

## TODO

### Spec

* [ ] MUST (security): [Filter inbox and outbox according to current permissions](https://www.w3.org/TR/activitypub/#delivery)
* [ ] MUST (security): [Don't disclose BTO/BCC to other users](https://www.w3.org/TR/activitystreams-vocabulary/#audienceTargeting)
* [ ] MUST: [Support other activities with side effects than `Create`](https://www.w3.org/TR/activitypub/#server-to-server-interactions)
* [ ] MUST: [Handle the case when recipients are collections](https://www.w3.org/TR/activitypub/#delivery)
* [ ] MAY: [Liked Collection](https://www.w3.org/TR/activitypub/#liked)
* [ ] MAY: [Likes Collection](https://www.w3.org/TR/activitypub/#likes)
* [ ] MAY: [Shares Collection](https://www.w3.org/TR/activitypub/#shares)
* [ ] MAY: [Shared Inbox Delivery](https://www.w3.org/TR/activitypub/#shared-inbox-delivery)

### Other / Related

* [ ] MUST (security): [Add support for HTTP signatures](https://tools.ietf.org/html/draft-ietf-httpbis-message-signatures)
* [ ] [Add support for WebFinger](https://tools.ietf.org/html/rfc7033)

### Code

* [ ] See the TODOs in the source code
* [ ] Open source (and / or rewrite) the tests
* [ ] Add interfaces for `final` classes
* [ ] Create a Symfony recipe
* [ ] Add support for MySQL and other DBMS (currently only Postgres is supported because of [this custom DQL function](src/Doctrine/JsonbAtGreater.php))

# Credits

Created by [Kévin Dunglas](https://dunglas.fr). Sponsored by [Les-Tilleuls.coop](https://les-tilleuls.coop).
