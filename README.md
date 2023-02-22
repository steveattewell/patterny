# Patterny image generator
Generates patterns as PNGs from any string. Useful for visually comparing two long text strings to see if they are the same (like bitcoin addresses so you can see if one was tampered with or mistyped, or miscopied).

<img width="881" alt="Two patterns generated by near-identical text strings" src="https://user-images.githubusercontent.com/21079244/220591270-1f36fe8b-9d13-40a4-bdb4-db0fb0bf2680.png">

# How to call directly
call **index.php** with **index.php?a=your-text-goes-here**

and this image will be returned:

![image](https://user-images.githubusercontent.com/21079244/220489934-8b7e36d9-0fe7-4ca4-9fae-22028491dc01.png)

# Use in an img tag:
```
<img src="index.php?a=iytf865rvr665rv6Srv7trfu86tf675">
<img src="index.php?a=1ytf865rvr665rv6Srv7trfu86tf675">
```

# Live demo
https://steveattewell.com/patterny/index.php?a=h87h8n987y9876t9bn6t9mb76t76tb7gftxs

# Useful for visually comparing two strings (like bitcoin addresses)
These strings look the same, but are subtly different...

**index.php?a=h87h8n987y9876t9bn6t9nb76t76tb7gftxs**

**index.php?a=h87h8n987y9876t9bn6t9mb76t76tb7gftxs**

Even though the strings are almost identical, patterny will generate two very different images, even though only one charachter has been changed:

![image](https://user-images.githubusercontent.com/21079244/220490348-91c64ae3-67a7-4695-bb2f-8ba499f5abd5.png)

![image](https://user-images.githubusercontent.com/21079244/220490419-3f41be8a-a0fa-4a4d-87ae-a78b96511163.png)

# options
### a (required)
A string of letters that you want to turn into a pattern. 
e.g. **index.php?a=mybitcoinaddress87y8ho8ybou7ytg7tcxstwv07f97tcvug** 


## You may also (optinally) include 
### pizelsize 
e.g. **pixelsize=10**
Pixelate the image. pizelsize is the size of each 'custom' pixel (in real pxels!) between 1 and 60

### imagesize
e.g. **imagesize=20**
the number of 'custom' pixels wide the image should be. Images will be constrained to a maxiumum of 600 real pixels wide. 

### hashfunction 
(not recommended at the mo as anything other than crc32 results in images that can be more difficult to tell apart)
e.g. **hashfunction=md5**
Can be one of:  'crc32', 'md5', 'sha1', 'sha256', 'sha512'
Defaults to 'crc32'.

##Putting it all together
```index.php?a=put-your-text-here&pixelsize=20&iagesize=20```
