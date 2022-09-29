<html>

<head>
    <title>api</title>
</head>

<body>

    <fieldset style="margin-bottom:25px;">
        <form name="form" method="get" action="{{route('app.api')}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <table border="0" width="100%">
                <tr>
                    <td height="30" colspan="2" align="left"><strong style="text-decoration:underline; color:#F00;">App
                            List</strong><br>
                        <div><strong>URL:</strong> <span id="url1"></span>
                            <script>
                            var url = "{{ url(''); }}";
                            var main = "/app-list";
                            document.getElementById('url1').innerHTML = url + main;
                            </script>
                        </div>
                        <div><strong>Method:</strong> POST </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <table width="100%" border="0" cellspacing="2" cellpadding="2">
                            <tr style="background-color:#162133; color:#FFF;">
                                <td><strong>App Name</strong></td>
                                <td><strong>Value</strong></td>
                                <td><strong>App Category</strong></td>
                                <td><strong>Mandatory</strong></td>
                                <td><strong>Note</strong></td>
                            </tr>
                            <tr>
                                <td>App Id</td>
                                <td><input type="text" name="appId"/></td>
                                <td>appCategoryId</td>
                                <td>Yes</td>
                                <td>--</td>
                            </tr>
                            <tr>
                                <td colspan="4" align="center"><input type="submit" value="Submit" /></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </form>

    </fieldset>

    <!--category list-->


    <fieldset style="margin-bottom:25px;">
        <form name="form" method="get" action="{{route('category.api')}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <table border="0" width="100%">
                <tr>
                    <td height="30" colspan="2" align="left"><strong
                            style="text-decoration:underline; color:#F00;">Category List</strong><br>
                        <div><strong>URL:</strong> <span id="url2"></span>
                            <script>
                            var url = "{{ url(''); }}";
                            var main = "/category-list";
                            document.getElementById('url2').innerHTML = url + main;
                            </script>
                        </div>
                        <div><strong>Method:</strong> POST </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <table width="100%" border="0" cellspacing="2" cellpadding="2">
                           <tr style="background-color:#162133; color:#FFF;">
                                <td><strong>Category Name</strong></td>
                                <td><strong>Value</strong></td>
                                <td><strong>Category</strong></td>
                                <td><strong>Mandatory</strong></td>
                                <td><strong>Note</strong></td>
                            </tr>
                             <!--  <tr>
                                <td>App Id</td>
                                <td><input type="text" name="appId" required /></td>
                                <td>appCategoryId</td>
                                <td>Yes</td>
                                <td>--</td>
                            </tr> -->
                            <tr>
                                <td>Category Id</td>
                                <td><input type="text" name="category_name" /></td>
                                <td>appCategoryName</td>
                                <td>Yes</td>
                                <td>--</td>
                            </tr>
                            <tr>
                                <td colspan="4" align="center"><input type="submit" value="Submit" /></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </form>

    </fieldset>



    <!--quiz list -->

    <fieldset>
        <form name="form" method="get" action="{{route('quiz.api')}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <table border="0" width="100%">
                <tr>
                    <td height="30" colspan="2" align="left"><strong style="text-decoration:underline; color:#F00;">Quiz
                            List</strong><br>
                        <div><strong>URL:</strong> <span id="url3"></span>
                            <script>
                            var url = "{{ url(''); }}";
                            var main = "/quiz-list";
                            document.getElementById('url3').innerHTML = url + main;
                            </script>
                        </div>
                        <div><strong>Method:</strong> POST </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <table width="100%" border="0" cellspacing="2" cellpadding="2">
                           <tr style="background-color:#162133; color:#FFF;">
                                <td><strong>Quiz Name</strong></td>
                                <td><strong>Value</strong></td>
                                <td><strong>Quiz Category</strong></td>
                                <td><strong>Mandatory</strong></td>
                                <td><strong>Note</strong></td>
                            </tr>
                            <!--<tr>
                                <td>App Id</td>
                                <td><input type="text" name="appId" required /></td>
                                <td>appCategoryId</td>
                                <td>Yes</td>
                                <td>--</td>
                            </tr>
                            <tr>
                                <td>Category Id</td>
                                <td><input type="text" name="categoryId" required /></td>
                                <td>appCategoryName</td>
                                <td>Yes</td>
                                <td>--</td>
                            </tr> -->
                            <tr>
                                <td>Quiz Id</td>
                                <td><input type="text" name="quizId" /></td>
                                <td>QuizCategoryName</td>
                                <td>Yes</td>
                                <td>--</td>
                            </tr>
                            <tr>
                                <td colspan="4" align="center"><input type="submit" value="Submit" /></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </form>

    </fieldset>





</body>

</html>