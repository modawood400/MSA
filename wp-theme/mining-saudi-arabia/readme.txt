=== Mining Saudi Arabia ===

News & media theme for MiningSaudiArabia.com. Operated by Mining News Company Limited.

== Install ==
1. Appearance → Themes → Add New → Upload Theme → choose mining-saudi-arabia.zip → Install → Activate.
2. Settings → Permalinks → Save (refreshes the URLs for the article / magazine / newsletter archives).
3. Appearance → Customize → Mining Saudi Arabia:
   - Mining Leaders episode: paste the YouTube link of the newest episode, guest name, title, company, date.
   - Forms: the email address that receives media-kit and meeting requests.
4. Optional: Appearance → Customize → Site Identity → Logo (otherwise the bundled logo is used).
5. Optional: Appearance → Menus → assign a menu to "Footer — Company links".

== Where the home page content comes from ==
- Ticker + Articles: the 6 / 9 latest "article" posts (featured image, first category, excerpt).
- Magazine: the 3 latest "magazine" posts. Featured image = cover. "Q3 2026" is read from the title.
- Mining Leaders: Customizer (see above).
- Event coverage, Our Reach, Work With Us: fixed in template-parts/events.php, reach.php, advertise.php.
- Newsletter issues: the 4 latest "newsletter" posts.

The theme uses the site's existing "article", "magazine" and "newsletter" post types. If they don't
exist (fresh install), it registers them itself. If none exist at all, it falls back to normal posts.

== Forms ==
- Media kit / meeting requests are saved under Leads (admin menu) and emailed to the Customizer address.
- Newsletter sign-ups are saved under Subscribers. Subscribers → Export CSV downloads the list.
- Developers can connect a CRM or email platform with the actions msa_lead_received and msa_subscriber_added.
- Make sure the site can send email (an SMTP plugin is recommended).

== Arabic ==
The EN / العربية switch translates the interface text and flips the layout to RTL.
Article titles and bodies stay in the language they were written in.
