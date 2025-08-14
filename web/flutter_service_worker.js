'use strict';
const MANIFEST = 'flutter-app-manifest';
const TEMP = 'flutter-temp-cache';
const CACHE_NAME = 'flutter-app-cache';

const RESOURCES = {"assets/AssetManifest.bin": "257562c59cca5690c9d1dcada5e6e96f",
"assets/AssetManifest.bin.json": "2d7ee1d883b66fee4304401365897314",
"assets/AssetManifest.json": "4e753ed3ae5d70601944969492c8eea3",
"assets/assets/ai_chat_assets/icons/ic_farmer.png": "53a89dda7399c9ff2b206e807147d3b0",
"assets/assets/ai_chat_assets/icons/ic_mic.png": "60f6df68cb8776691a03551370912823",
"assets/assets/ai_chat_assets/icons/ic_more.png": "200cc8d34506ae4308efd0f843cb23e9",
"assets/assets/ai_chat_assets/icons/ic_send.png": "7027a2f11304c754583fcb2ae3772053",
"assets/assets/ai_chat_assets/icons/ic_slash.png": "3449e1612bccd547c40b0ba8c6d6048d",
"assets/assets/ai_chat_assets/icons/ic_ternakbot.png": "c816a353b816ebde13a2789afaf889f3",
"assets/assets/ai_chat_assets/images/img_background.png": "3ab6f2b3278ed15bbd3b5b04f526572a",
"assets/assets/app_launcher.png": "d9fe840d5f607e9662f042afd49e3c21",
"assets/assets/auth_assets/icons/ic_back.png": "59c7b77219a848c278a078f75d84a198",
"assets/assets/auth_assets/icons/ic_eye_active.png": "2edbac236401a6308d1ff6ffcb93baf1",
"assets/assets/auth_assets/icons/ic_eye_unactive.png": "19f11000a35731bbee49876fd357721e",
"assets/assets/auth_assets/icons/ic_google.png": "48a6650573724376582a66267a283e63",
"assets/assets/auth_assets/icons/ic_lock.png": "3860b7a9ade5054a7cca2e3c129c1628",
"assets/assets/auth_assets/icons/ic_mail.png": "461afcbfd41f08fee0f5e0742fb3a59a",
"assets/assets/auth_assets/icons/ic_user.png": "4daa33b87a67791423949b3d12517958",
"assets/assets/auth_assets/illustrations/1.png": "e25c9f566fbc6e18c5ddcdf20d35ddf3",
"assets/assets/banner_bottom.png": "38d8fbf031ed7c6ad50cc9f199c2b779",
"assets/assets/banner_bottom_2.png": "a626874576ab9a502eba7c588e2248b8",
"assets/assets/biaya_pakan_assets/icons/ayam.png": "aea4b5c5e20baf00f6558e80bd040dcf",
"assets/assets/biaya_pakan_assets/icons/ic_calender.png": "224edc692d9be57b9db8ef913da28102",
"assets/assets/biaya_pakan_assets/icons/ic_dropdown.png": "20401567ae6e6c65344f6d5d038a8994",
"assets/assets/biaya_pakan_assets/icons/ic_lamp.png": "c06d3a1a8fed6e6dad03c95ad66519c5",
"assets/assets/biaya_pakan_assets/icons/ic_plus.png": "4fa267f3bfe01cdea67d883503290d10",
"assets/assets/biaya_pakan_assets/icons/ic_plus_minus.png": "943b084beacff1416ee91dd3779e0e8c",
"assets/assets/biaya_pakan_assets/icons/sapi.png": "08ad16bc9042c0d84ea16e4608ca004d",
"assets/assets/data_ternak_assets/icons/ic_add_data_ternak.png": "efc2465d0f956db2ad5532ff7b7686bf",
"assets/assets/data_ternak_assets/icons/ic_add_tugas.png": "b09f0503d6b65bf0449ca283df7722a9",
"assets/assets/data_ternak_assets/icons/ic_back.png": "b9cef432cc061080951ea138342dc7fa",
"assets/assets/data_ternak_assets/icons/ic_calendar.png": "ac436696323175705117445ee171afdd",
"assets/assets/data_ternak_assets/icons/ic_checklist.png": "09c8bcc4f18e6999593dfb22833e0423",
"assets/assets/data_ternak_assets/icons/ic_check_green.png": "cec5a865e0ca2582f346457a96859bc6",
"assets/assets/data_ternak_assets/icons/ic_check_yellow.png": "0121f20c590fd68d07376b033cd49917",
"assets/assets/data_ternak_assets/icons/ic_clock.png": "05139f4660b607b11b474292f11d4d6b",
"assets/assets/data_ternak_assets/icons/ic_clock_green.png": "ea0a69d83c2accef9e3158aac18c8d37",
"assets/assets/data_ternak_assets/icons/ic_clock_red.png": "f1c5471fd01a6b85d26603596c813e24",
"assets/assets/data_ternak_assets/icons/ic_cow.png": "917c3766a47de441adda272a1c3ab6ac",
"assets/assets/data_ternak_assets/icons/ic_cow_hd.png": "08ad16bc9042c0d84ea16e4608ca004d",
"assets/assets/data_ternak_assets/icons/ic_dropdown.png": "20401567ae6e6c65344f6d5d038a8994",
"assets/assets/data_ternak_assets/icons/ic_kelola_keuangan.png": "e76e3684506d9e197d1ab9917d6b3e22",
"assets/assets/data_ternak_assets/icons/ic_more.png": "a69382537e750d467fd4c693df628593",
"assets/assets/data_ternak_assets/icons/ic_repeat.png": "6151429fba045e4cae0526b8a3c00f21",
"assets/assets/data_ternak_assets/icons/ic_ternak.png": "586e1d239e6c348c7236d850399d3c3b",
"assets/assets/data_ternak_assets/icons/ic_ternak_active.png": "83d1094b8a86c08c89ba9a8f3e6dfb1f",
"assets/assets/data_ternak_assets/icons/ic_tugas.png": "778720bcc0ca32771b94876e06c09f86",
"assets/assets/data_ternak_assets/icons/ic_tugas_active.png": "ad6ffbfc17025056b313e1b1d826632e",
"assets/assets/data_ternak_assets/icons/ic_update_data_ternak.png": "ca702ecc116e2940d785e9ce3bb18e6c",
"assets/assets/data_ternak_assets/icons/ic_weight_indicator.png": "53cee47d4f8d0fb7b71f9a7c8c61702a",
"assets/assets/data_ternak_assets/illustrations/cow_hamil.png": "33c290a239a5eab358bbdce631511cdb",
"assets/assets/data_ternak_assets/illustrations/cow_jumlah.png": "aec3abe9d03a85a9b06a14a8b2491520",
"assets/assets/data_ternak_assets/illustrations/cow_meninggal.png": "f6b6a34d09b5e434065becb242cf832d",
"assets/assets/data_ternak_assets/illustrations/cow_pakan.png": "a25a6263d5a7b4beb4b13bd96197a58f",
"assets/assets/data_ternak_assets/illustrations/cow_panen.png": "3e5c19ef755750938eca97679aac7492",
"assets/assets/data_ternak_assets/illustrations/cow_penyimpanan.png": "4ddb5e86500fdb540d8e13b9f774ef48",
"assets/assets/data_ternak_assets/illustrations/cow_sakit.png": "6bac6a3574ff859902b28b950dd061d9",
"assets/assets/data_ternak_assets/illustrations/cow_usia.png": "a961834feca3e0574d0211ccffcfb3cc",
"assets/assets/harga_pasar_assets/icons/ic_arrow_down.png": "940b162a04dc32f08677ad3eac4d766f",
"assets/assets/harga_pasar_assets/icons/ic_arrow_up.png": "0be49b9211e8374cffbec61f24dca882",
"assets/assets/harga_pasar_assets/icons/ic_back.png": "e7a3af93dd1840649f59899aec8c4fbe",
"assets/assets/harga_pasar_assets/icons/ic_filter.png": "f59f380bfc432c2784511af5188cf7d7",
"assets/assets/harga_pasar_assets/icons/ic_location.png": "f954a344a6dddf333c8d81822d4088e8",
"assets/assets/harga_pasar_assets/icons/ic_search.png": "b2342df74066790590f4a34d36c759fe",
"assets/assets/harga_pasar_assets/icons/ic_strip.png": "62c218c5d86c44e4c25cdd2cf1935c89",
"assets/assets/harga_pasar_assets/images/daging_ayam.png": "03d4a4203b429554507e69e7d91456d7",
"assets/assets/harga_pasar_assets/images/dagi_sapi.png": "436f9d6e15f1a1889bdb197e14b7cf8f",
"assets/assets/harga_pasar_assets/images/susu_kambing.png": "ec50daa251fd2884ef6d9529f05beb00",
"assets/assets/harga_pasar_assets/images/telur.png": "ea59d69bb75e862595b5a77fc7e3cac0",
"assets/assets/home_assets/icons/ic_ai_agent.png": "77e2b955d84d5b43c4a9c3b14de825e7",
"assets/assets/home_assets/icons/ic_arrow.svg": "3d2ea98d68b64180978df098befe5b39",
"assets/assets/home_assets/icons/ic_bell.png": "fe982ee3f028f82f1368aa5210695fc9",
"assets/assets/home_assets/icons/ic_check_green.png": "cec5a865e0ca2582f346457a96859bc6",
"assets/assets/home_assets/icons/ic_check_yellow.png": "0121f20c590fd68d07376b033cd49917",
"assets/assets/home_assets/icons/ic_clock.png": "f1c5471fd01a6b85d26603596c813e24",
"assets/assets/home_assets/icons/ic_clock_green.png": "ea0a69d83c2accef9e3158aac18c8d37",
"assets/assets/home_assets/icons/ic_clock_red.png": "f1c5471fd01a6b85d26603596c813e24",
"assets/assets/home_assets/icons/ic_cow.png": "351195ea4b861e485083596e6305a00b",
"assets/assets/home_assets/icons/ic_dropdown.png": "20401567ae6e6c65344f6d5d038a8994",
"assets/assets/home_assets/icons/ic_invest.png": "d4b3cd09f11d225428e8562accc10d57",
"assets/assets/home_assets/icons/ic_location.png": "5bc58bbd31536ef22d7056dec3c5f166",
"assets/assets/home_assets/icons/ic_more.png": "a69382537e750d467fd4c693df628593",
"assets/assets/home_assets/icons/ic_plus.png": "39496aed36efeb3df73b22f4488cd4f7",
"assets/assets/home_assets/icons/ic_shield.png": "37973051accc146d193b3ac01463e512",
"assets/assets/home_assets/icons/ic_snack.png": "32fc5cdd8d93e844bcdf97bfb942ed99",
"assets/assets/home_assets/icons/ic_task.png": "fccc5bf4429d2f97a4d54e512bee84e2",
"assets/assets/home_assets/icons/ic_task_add.svg": "37b23392b932ec42cf6244cf429a44b6",
"assets/assets/home_assets/icons/ic_update.png": "f5eef2dfc1f451aae352012f1a54ce53",
"assets/assets/home_assets/images/dummy_1.png": "b7f6fe399a5d2b4b4556a4c709df82ca",
"assets/assets/home_assets/images/dummy_2.png": "c18892501136fcf2d07851b7ac0deef1",
"assets/assets/home_assets/images/img_amelia_1_1.png": "64d3a9b150771def47faf2a48a0281ca",
"assets/assets/home_assets/images/img_amelia_1_2.png": "aa93cdafbbe0b072aaec69cdd714a119",
"assets/assets/home_assets/images/img_amelia_1_3.png": "4522b1572e8e94b91b4aca18c29a3e43",
"assets/assets/home_assets/images/img_amelia_1_4.png": "803dba34bf82b3f6eaeb3b79545e2997",
"assets/assets/home_assets/images/img_not_found.png": "a88029aaad6e6ea7596096c7c451840b",
"assets/assets/home_assets/images/img_star.png": "6ba72d3e3628aad6481f11b8b299fe00",
"assets/assets/ic_full.png": "8bfe1dcf0f22da6d3bd6fdb88581bd00",
"assets/assets/ic_launcher.png": "76a8fbbf3df30f454eb1af66029a83ea",
"assets/assets/keuangan_assets/icons/ic_add.png": "d6626fa3c01c3cf19d193eb21e7833f0",
"assets/assets/keuangan_assets/icons/ic_cart.png": "c719b86ec334125b21aa460963069f47",
"assets/assets/keuangan_assets/icons/ic_down.png": "1d6955fa8592d842055a4335ac220263",
"assets/assets/keuangan_assets/icons/ic_down_active.png": "2fd711b02dd843652d6157c01ced1795",
"assets/assets/keuangan_assets/icons/ic_up.png": "06b81d358cf9da277eb674c83070744e",
"assets/assets/keuangan_assets/icons/ic_up_active.png": "955eee522fd979c1728288d5d496dba5",
"assets/assets/keuangan_assets/icons/ic_wallet.png": "9247f881c2c0ac561e5eb3addac36cdc",
"assets/assets/keuangan_assets/images/header_main.png": "8c0688d82658da4729ddb3915e21072b",
"assets/assets/konsultasi_assets/icons/ic_konsul_1.png": "333c3ffb6d769e1d2be0ea62eaabd1a0",
"assets/assets/konsultasi_assets/icons/ic_konsul_2.png": "f21786cec876d462a2e3229cca113046",
"assets/assets/konsultasi_assets/icons/ic_konsul_3.png": "c622ad1ddb2e15287f83cf86bcd7e1e1",
"assets/assets/konsultasi_assets/icons/ic_konsul_4.png": "9523e2e51b60f0d4e7333c1baff88801",
"assets/assets/konsultasi_assets/icons/ic_search.png": "29c9b28587af97ee9abb6b8fc20845ab",
"assets/assets/konsultasi_assets/illustrations/img_person.png": "f4d61a6288bb5ec11c5811b7b31d742a",
"assets/assets/navbar_assets/active/1.png": "79e052cc6622cd84954b42eff4199763",
"assets/assets/navbar_assets/active/2.png": "c20344c7fcabddb2d63f36f827718777",
"assets/assets/navbar_assets/active/3.png": "4e1b0cf3686bc1761623fe5170bd1fc6",
"assets/assets/navbar_assets/active/4.png": "5f2120f4c0ac918aad4183c06e98706b",
"assets/assets/navbar_assets/ic_ai_voice.png": "f353e9249314c9d41dc7158a4e120664",
"assets/assets/navbar_assets/inactive/1.png": "37ac77d5f16aa25205029194bee33f50",
"assets/assets/navbar_assets/inactive/2.png": "8f2b8c30cc5754c701587b480bf9f678",
"assets/assets/navbar_assets/inactive/3.png": "ff68efdb516f84cb4270328123337062",
"assets/assets/navbar_assets/inactive/4.png": "1eff24d707da7cfe8f59baf0fa1a7098",
"assets/assets/onboarding_assets/header/1.png": "e3b198331833e43ebb50edf97e623e78",
"assets/assets/onboarding_assets/header/2.png": "1c2d49420ec56547eb9f931821f52788",
"assets/assets/onboarding_assets/header/3.png": "186e37f6ca2c20bfa54e175d70b522b7",
"assets/assets/onboarding_assets/header/4.png": "a53976bf774c49c7033a001538d3f448",
"assets/assets/onboarding_assets/ic_skip.png": "9e47fbd26ec40c37973e2b3592259a31",
"assets/assets/onboarding_assets/illustrations/1.png": "5bd53a734def0880b4955cdabb188d2c",
"assets/assets/onboarding_assets/illustrations/2.png": "35821aee931a85d7223904114412ff8e",
"assets/assets/onboarding_assets/illustrations/3.png": "9e4c26278d0532f16ae1a1d6c8a915de",
"assets/assets/onboarding_assets/illustrations/4.png": "f4be64678fafbe3775c07170c2fb9376",
"assets/assets/profile_assets/icons/ic_arrow_go.png": "99c7cab54c042a5cb71a49a9a5c7169b",
"assets/assets/profile_assets/icons/ic_bell.png": "1865a780c707055f6f9e07f81967b6a9",
"assets/assets/profile_assets/icons/ic_faq.png": "519f1ab80aebee2be0e1f2cc61cb3ab0",
"assets/assets/profile_assets/icons/ic_farmer.png": "53a89dda7399c9ff2b206e807147d3b0",
"assets/assets/profile_assets/icons/ic_feature.png": "5006b4614beea63f302cf5dd10fc54dd",
"assets/assets/profile_assets/icons/ic_loc.png": "b32d657e493572b298830c3a6f524d80",
"assets/assets/profile_assets/icons/ic_lock.png": "22bd75a21ddc0c55f3f6f91f209aea00",
"assets/assets/profile_assets/icons/ic_mail.png": "107eba8b98f4b7e085e996b8fe27e40b",
"assets/assets/profile_assets/icons/ic_mode.png": "714f0bee5a24b5fc357c389c9d85dedc",
"assets/assets/profile_assets/icons/ic_out.png": "a4b2fe3622f2c65f2bc7a726750042c3",
"assets/assets/profile_assets/icons/ic_pencil.png": "6ebc6db0b5b33c09debc71711a734a2b",
"assets/assets/profile_assets/icons/ic_phone.png": "23ac5ab33fac9785329205525bb41d04",
"assets/assets/profile_assets/icons/ic_user.png": "28d0bbfa3148731312f6f76926056b9e",
"assets/assets/rekomendasi_ternak_assets/icons/ic_arrow_right.png": "0ab0e4fd6e09cd5fcd4d9952faca5a7c",
"assets/assets/rekomendasi_ternak_assets/icons/ic_arrow_top.png": "4ff71521009ef485a3c6e43890a4321d",
"assets/assets/rekomendasi_ternak_assets/icons/ic_bow.png": "bbde55646ff063bbf82dad9c221fb2d8",
"assets/assets/rekomendasi_ternak_assets/icons/ic_checklist.png": "6b2462fd0f9c34babc7b3e9e710faf71",
"assets/assets/rekomendasi_ternak_assets/icons/ic_cheklist_no-fill.png": "87f443f1766809cc59d77d53855f201a",
"assets/assets/rekomendasi_ternak_assets/icons/ic_clock.png": "5c37c4356ce7696ddd0014de87aa7ea8",
"assets/assets/rekomendasi_ternak_assets/icons/ic_danger.png": "8a059354a7f815e53f8fd96c727d9f1f",
"assets/assets/rekomendasi_ternak_assets/icons/ic_farmer.png": "5edcadba79b67c0bd75e522b117511ce",
"assets/assets/rekomendasi_ternak_assets/icons/ic_lamp.png": "c06d3a1a8fed6e6dad03c95ad66519c5",
"assets/assets/rekomendasi_ternak_assets/icons/ic_leaf.png": "d2372d2f9aa6e2c1904a4537fe412166",
"assets/assets/rekomendasi_ternak_assets/icons/ic_location_farm.png": "cdc789fb013cf37bba6d209784f32c52",
"assets/assets/rekomendasi_ternak_assets/icons/ic_minta.png": "e9c14ab98bda0183cc51de3e5f9b43fe",
"assets/assets/rekomendasi_ternak_assets/icons/ic_money.png": "a35ff3c1de1eed6061424d714204080d",
"assets/assets/rekomendasi_ternak_assets/icons/ic_money_banyak.png": "4028bdae06d4bb3a1e9bb82aa2d9b54e",
"assets/assets/rekomendasi_ternak_assets/icons/ic_pin_location.png": "299ddb09e5dadf77ebff24a89e6f6fe9",
"assets/assets/rekomendasi_ternak_assets/icons/ic_plant.png": "b08a13dd65838c748ffcd99cb4029714",
"assets/assets/rekomendasi_ternak_assets/images/images_ayam.png": "368c6e3d26d49f39e7a9b99c5bb225ad",
"assets/assets/rekomendasi_ternak_assets/images/images_cow.png": "88bcf5dcd13cbae4173fe18dc40ae692",
"assets/FontManifest.json": "dc3d03800ccca4601324923c0b1d6d57",
"assets/fonts/MaterialIcons-Regular.otf": "8f10aec9e71009cd52bef7f394017ca8",
"assets/NOTICES": "960699e3f9f03b2b3475e57aedbc889f",
"assets/packages/cupertino_icons/assets/CupertinoIcons.ttf": "33b7d9392238c04c131b6ce224e13711",
"assets/shaders/ink_sparkle.frag": "ecc85a2e95f5e9f53123dcaf8cb9b6ce",
"canvaskit/canvaskit.js": "728b2d477d9b8c14593d4f9b82b484f3",
"canvaskit/canvaskit.js.symbols": "bdcd3835edf8586b6d6edfce8749fb77",
"canvaskit/canvaskit.wasm": "7a3f4ae7d65fc1de6a6e7ddd3224bc93",
"canvaskit/chromium/canvaskit.js": "8191e843020c832c9cf8852a4b909d4c",
"canvaskit/chromium/canvaskit.js.symbols": "b61b5f4673c9698029fa0a746a9ad581",
"canvaskit/chromium/canvaskit.wasm": "f504de372e31c8031018a9ec0a9ef5f0",
"canvaskit/skwasm.js": "ea559890a088fe28b4ddf70e17e60052",
"canvaskit/skwasm.js.symbols": "e72c79950c8a8483d826a7f0560573a1",
"canvaskit/skwasm.wasm": "39dd80367a4e71582d234948adc521c0",
"favicon.png": "5dcef449791fa27946b3d35ad8803796",
"flutter.js": "83d881c1dbb6d6bcd6b42e274605b69c",
"flutter_bootstrap.js": "c919be021b41dd8a2518d1b5f8a50c1c",
"icons/Icon-192.png": "ac9a721a12bbc803b44f645561ecb1e1",
"icons/Icon-512.png": "96e752610906ba2a93c65f8abe1645f1",
"icons/Icon-maskable-192.png": "c457ef57daa1d16f64b27b786ec2ea3c",
"icons/Icon-maskable-512.png": "301a7604d45b3e739efc881eb04896ea",
"index.html": "807ce78d0cbbd6a7e8f6efdb46820d7d",
"/": "807ce78d0cbbd6a7e8f6efdb46820d7d",
"main.dart.js": "3f7a6d45aadedc89f4a688156435f411",
"manifest.json": "1611b7ce796376054255e2fb7346efcf",
"version.json": "e3e36aa598cbaccf023e2fcba30baf0c"};
// The application shell files that are downloaded before a service worker can
// start.
const CORE = ["main.dart.js",
"index.html",
"flutter_bootstrap.js",
"assets/AssetManifest.bin.json",
"assets/FontManifest.json"];

// During install, the TEMP cache is populated with the application shell files.
self.addEventListener("install", (event) => {
  self.skipWaiting();
  return event.waitUntil(
    caches.open(TEMP).then((cache) => {
      return cache.addAll(
        CORE.map((value) => new Request(value, {'cache': 'reload'})));
    })
  );
});
// During activate, the cache is populated with the temp files downloaded in
// install. If this service worker is upgrading from one with a saved
// MANIFEST, then use this to retain unchanged resource files.
self.addEventListener("activate", function(event) {
  return event.waitUntil(async function() {
    try {
      var contentCache = await caches.open(CACHE_NAME);
      var tempCache = await caches.open(TEMP);
      var manifestCache = await caches.open(MANIFEST);
      var manifest = await manifestCache.match('manifest');
      // When there is no prior manifest, clear the entire cache.
      if (!manifest) {
        await caches.delete(CACHE_NAME);
        contentCache = await caches.open(CACHE_NAME);
        for (var request of await tempCache.keys()) {
          var response = await tempCache.match(request);
          await contentCache.put(request, response);
        }
        await caches.delete(TEMP);
        // Save the manifest to make future upgrades efficient.
        await manifestCache.put('manifest', new Response(JSON.stringify(RESOURCES)));
        // Claim client to enable caching on first launch
        self.clients.claim();
        return;
      }
      var oldManifest = await manifest.json();
      var origin = self.location.origin;
      for (var request of await contentCache.keys()) {
        var key = request.url.substring(origin.length + 1);
        if (key == "") {
          key = "/";
        }
        // If a resource from the old manifest is not in the new cache, or if
        // the MD5 sum has changed, delete it. Otherwise the resource is left
        // in the cache and can be reused by the new service worker.
        if (!RESOURCES[key] || RESOURCES[key] != oldManifest[key]) {
          await contentCache.delete(request);
        }
      }
      // Populate the cache with the app shell TEMP files, potentially overwriting
      // cache files preserved above.
      for (var request of await tempCache.keys()) {
        var response = await tempCache.match(request);
        await contentCache.put(request, response);
      }
      await caches.delete(TEMP);
      // Save the manifest to make future upgrades efficient.
      await manifestCache.put('manifest', new Response(JSON.stringify(RESOURCES)));
      // Claim client to enable caching on first launch
      self.clients.claim();
      return;
    } catch (err) {
      // On an unhandled exception the state of the cache cannot be guaranteed.
      console.error('Failed to upgrade service worker: ' + err);
      await caches.delete(CACHE_NAME);
      await caches.delete(TEMP);
      await caches.delete(MANIFEST);
    }
  }());
});
// The fetch handler redirects requests for RESOURCE files to the service
// worker cache.
self.addEventListener("fetch", (event) => {
  if (event.request.method !== 'GET') {
    return;
  }
  var origin = self.location.origin;
  var key = event.request.url.substring(origin.length + 1);
  // Redirect URLs to the index.html
  if (key.indexOf('?v=') != -1) {
    key = key.split('?v=')[0];
  }
  if (event.request.url == origin || event.request.url.startsWith(origin + '/#') || key == '') {
    key = '/';
  }
  // If the URL is not the RESOURCE list then return to signal that the
  // browser should take over.
  if (!RESOURCES[key]) {
    return;
  }
  // If the URL is the index.html, perform an online-first request.
  if (key == '/') {
    return onlineFirst(event);
  }
  event.respondWith(caches.open(CACHE_NAME)
    .then((cache) =>  {
      return cache.match(event.request).then((response) => {
        // Either respond with the cached resource, or perform a fetch and
        // lazily populate the cache only if the resource was successfully fetched.
        return response || fetch(event.request).then((response) => {
          if (response && Boolean(response.ok)) {
            cache.put(event.request, response.clone());
          }
          return response;
        });
      })
    })
  );
});
self.addEventListener('message', (event) => {
  // SkipWaiting can be used to immediately activate a waiting service worker.
  // This will also require a page refresh triggered by the main worker.
  if (event.data === 'skipWaiting') {
    self.skipWaiting();
    return;
  }
  if (event.data === 'downloadOffline') {
    downloadOffline();
    return;
  }
});
// Download offline will check the RESOURCES for all files not in the cache
// and populate them.
async function downloadOffline() {
  var resources = [];
  var contentCache = await caches.open(CACHE_NAME);
  var currentContent = {};
  for (var request of await contentCache.keys()) {
    var key = request.url.substring(origin.length + 1);
    if (key == "") {
      key = "/";
    }
    currentContent[key] = true;
  }
  for (var resourceKey of Object.keys(RESOURCES)) {
    if (!currentContent[resourceKey]) {
      resources.push(resourceKey);
    }
  }
  return contentCache.addAll(resources);
}
// Attempt to download the resource online before falling back to
// the offline cache.
function onlineFirst(event) {
  return event.respondWith(
    fetch(event.request).then((response) => {
      return caches.open(CACHE_NAME).then((cache) => {
        cache.put(event.request, response.clone());
        return response;
      });
    }).catch((error) => {
      return caches.open(CACHE_NAME).then((cache) => {
        return cache.match(event.request).then((response) => {
          if (response != null) {
            return response;
          }
          throw error;
        });
      });
    })
  );
}
