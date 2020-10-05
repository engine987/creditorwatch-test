# Creditor Watch test

The CEO from CreditorWatch is very interested in SEO and how this can improve Sales. Every
morning he logs into google.com.au and types in the same key words “creditor watch” and
counts down to see where and how many times the company, www.creditorwatch.com.au
appears.
Seeing the CEO do this every day, a smart software developer at CreditorWatch decides to
write a small application for him that will automatically perform this operation and return the
result to the screen. They design and code some software that receives a string of keywords
(E.G. “creditorwatch”) and a URL (E.G. “www.creditorwatch.com.au”). This is then processed to
return a list of numbers for where the resulting URL is found in the Google results.

For example, “1, 10, 33” or “0”

The CEO is only interested if their URL appears in the first 100 results.
Requirements:
-  No frameworks are to be used.
-  Please use at least one design pattern when coding this solution. Clearly comment why
this design pattern was used (or include a note in your submission).
- Given that this will be used by used by the CEO, please produce a small HTML
frontend.
- Make sure you include unit tests showing how you would test the code.
Recommendations:
- This is a simple task however it is important to note that although a complete/correct
solution is required, it is not the only measurement. Please use this project as an
opportunity to demonstrate knowledge and programming concepts.
- We understand that this is a test and sometimes shortcuts will be made. We highly
encourage you to write as many notes as possible in the README file as you can to
describe what you would do differently in a production environment. We don’t expect
this solution to take very long and understand that this is an after-work activity. Given
that, please ensure you explain yourself well in the README file regarding the shortcuts
you have taken.

## How to run : 
1. Clone the repository
2. cd into the application directory
3. Run : ``composer install``
4. Run: ``/usr/bin/php -S localhost:8000 -t .``
5. Open http://localhost:8000 in a browser

## Details
1. I have used Factory method to create Search Clients, Dependency injection so that my classes are not tied down to any one impletementation of a Search Service, and the Facade pattern to hide the complexity of the Search Service.
2. I have written the code around "services" where GoogleSearchService acts as an entry point into 
   searching Google. If we were searching Bing, there could be a "BingSearchService".  
2. This code works on PHP 7.3 running on Mac OS. 
3. ### Short cuts
    - (a) The Service can be expanded to give other information also (like stats), not just links
    - (b) The HTML interface is not pretty, in a production environment, I would be using a CSS Library like Bootstrap
    - (c) I do not have a 100% percent code coverage, but I have written tests to demonstrate that I understand mocks.  
        
    
