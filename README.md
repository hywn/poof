# poof
this is simple file hosting like pomf

## details
- stores actual file data in sqlite
- database stores sha1 hash, mimetype, and data

## thoughts
- atm <100lines PHP and <100lines HTML, which is cool
- am pretty sure storing files in sqlite is as fine as storing files on computer; will probably only become problem once you want to split servers up?
- yeah idk
- sha1 vs sha256??? I doubt that anyone will actually use this software let alone use it heavily enough to eventually create a collision...

## some other plans I have but idk will eventually do
- add option of filtering mimetypes?
	- refuse to host some mimetypes
	- host some as others
- decide on some file upload limit
	- set it in PHP
	- add a check in `index.html` BEFORE uploading for politeness
- hook it up to my uni's security signon thing and then store username with file data to hold people responsible for uploading bad things??
- return hashes as some kind of base?? thing to make them shorter