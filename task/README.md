# Developer test
- Import the attached database schema including data into a mysql database
- Create a web service with three endpoints:
    - First endpoint should deliver site and site_id
    - Second endpoint should deliver an article lists based on site_id, sorted by published_date
    - Third endpoint should deliver a single article
- Create a frontend consisting of two pages:
    - First page should render all articles from a specific site_id, it should be possible to chose between sites.
    - Second page should render the article with content
- See attached wireframes for layout, choose appropriate fonts and colors
- Don't worry too much about presentation of all elements in content
    - There might be complex elements like fact_box
- Both pages should be responsive
- Use unit tests wehere applicable
- The solution should be delivered as a GitHub repository and include:
    - Documentation
    - How to run it
    - How to get dependencies
- Any use of frameworks will be scrutinised in regards to cost/benefit
- Use PHP to create the web services
- Use PHP or JavaScript to render the web pages

## Image scaling:
Too scale an image, use the original image url:
```
https://img.gfx.no/2345/2345828/Vann-%20og%20avlopsetaten_9.jpg
```
If you want to scale and crop an image from the center to 300 px width and 150 px heigth add `300x150c` to the url like this:
```
https://img.gfx.no/2345/2345828/Vann-%20og%20avlopsetaten_9.300x150c.jpg
```
