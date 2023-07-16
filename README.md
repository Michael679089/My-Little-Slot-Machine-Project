---

```
I am parsing this markdown file using the "ParseDown" library made by a user named "erusev".
```

# **How does this project work?**

- There is a button that says spin the machine which will trigger a coroutine. A timer will start which in total is 1 second.
- Another coroutine will also start which will be also the same total time, it will be the callback function that triggers the php code.

- (From left to right) the first symbol will end 1/3 of the total time, while the second symbol will end at 2/3 of the total time, and the last symbol will end at 3/3 of the total time.

- After the timer is stopped. The javascript will get the string from the first symbol, second symbol, and the third symbol.

- The Javascript will check if all three symbols are equal. If not, the javascript will go to the lottery.php script and say that they aren't equal.
- The lottery.php script sees this and makes the $_SESSION variable of the winstreak to return to zero.
