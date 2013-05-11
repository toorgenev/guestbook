Guest book.

!!! Not for production, only for code review, as test task for interview.

1. Generals
    Application based on MVC model with namespaces. Models, Controllers and Views
    are in the appropriate folders in folder ./App
    All system classes are in the ./System folder
    Folder ./www contains static files (js, css, images);
2. Application
    Application is instance of class System\Application and contains base elements,
    such as request router and DB component. Should be only one instance of Application
    per request, that's why there is System\App class, which realize Singleton
    pattern for Application.
3. Routing
    All requests (exclude request to static files) redirect to index.php script 
    with RewriteEngine (for Apache). Routing mechanism is in System\Applicatin class,
    method Run.
4. Views
    For views displaying Controllers has method Render. Needed view is selected 
    based on the controller name and the view name passed as a parameter. Second 
    parameter of Render function is Layout (true/false). If true, layout file is
    rendered and view file content insert in layout. Layout file name specified 
    as "layout" property in Conttroller class.
5. DB
    Use MySQL db. Db name - guest. Mysqldump of DB - in ./App/Data/db.sql