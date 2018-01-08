<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('includes/head'); ?>
</head>

<body>
<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
    <?php $this->load->view('includes/sidebar'); ?>
    <div class="mainpanel">
        <?php $this->load->view('includes/header'); ?>


        <div class="pageheader">
            <h2><i class="fa fa-home"></i> Blank <span>Subtitle goes here...</span></h2>
            <div class="breadcrumb-wrapper">
                <span class="label">You are here:</span>
                <ol class="breadcrumb">
                    <li><a href="index.html">Bracket</a></li>
                    <li class="active">Blank</li>
                </ol>
            </div>
        </div>

        <div class="contentpanel">
            <div class="row">

                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Kategori Düzenleme </h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Kategori ID:</label>
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="Default Input" class="form-control fc-xs-round" ng-model="CategoryEdit.Id" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Reyon Adı:</label>
                                    <div class="col-sm-6">
                                        <select class="form-control fc-sm-round" ng-model="CategoryEdit.model">
                                            <option ng-repeat="showcase in Showcases" value="{{option.ReyonId}}">{{showcase.ReyonAdi}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Kategori Adı :</label>
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="Default Input" class="form-control fc-sm-round" ng-model="CategoryEdit.Adi" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Kategori Açıklama :</label>
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="Default Input" class="form-control fc-x-sm-round" ng-model="CategoryEdit.Aciklama" />
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div><!-- modal-content -->
                    </div><!-- modal-dialog -->
                </div><!-- modal -->

                <div class="row">
                    <div class="col-md-4">
                        <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">
                            Launch Modal
                        </button>
                    </div>
                </div>
                <div class="col-md-12">

                    <table class="table dataTable no-footer" id="tblCategoryList">
                        <thead>
                            <th><input type="checkbox" ng-click="selectAll()" ng-model="isSelectAll" /></td>
                            <th>Sıra No</th>
                            <th>Kategori Adı</th>
                            <th>Açıklama</th>
                            <th>Durum</th>
                        </thead>
                        <tbody>
                            <tr ng-repeat="category in categories" ng-dblclick="go(category);" ng-class="class">
                                <td><input type="checkbox" ng-model="category.isSelect" /></td>
                                <td>{{category.Id}}</td>
                                <td>{{category.Adi}}</td>
                                <td>{{category.Aciklama}}</td>
                                <td ng-if="category.Aktif == '1'">
                                    <span class="label label-success">Aktif</span>
                                </td>
                                <td ng-if="category.Aktif == '0'">
                                    <span class="label label-danger">Pasif</span>
                                </td>
                            </tr>
                        </tbody>
                 </table>
                </div>
            </div>
        </div>
    </div><!-- mainpanel -->
</section>

<?php $this->load->view("includes/footer");?>

<script type="application/javascript">
    var baseurl = "<?php print base_url('Category'); ?>";


    var AppCat = angular.module('CatApp',[]);


    AppCat.controller("app-category",function($scope,$http){

        //****************Kategori Listesi ************************
        $scope.categories = [];
        $http({
            method: 'POST',
            url: baseurl+"/CategoryList",
        }).then(function successCallback(response) {
         //   if (response.status=200)
         //       alert(response.data.length);
            $scope.categories=response.data;
            console.log(response);
        }, function errorCallback(response) {
            // called asynchronously if an error occurs
            // or server returns response with an error status. isSearchSelect
        });

        //****************Reyon Listesi ************************
        $scope.Showcases = [];
        $http({
            method: 'POST',
            url: baseurl+"/ShowcasesList",
        }).then(function successCallback(response) {
            $scope.Showcases=response.data;
            console.log(response);
        }, function errorCallback(response) {
            console.log(response);
        });

        $scope.isSearchSelect = function () {
            angular.forEach($scope.categories, function (category) {
                if (category.isSelect){
                    alert (category.Adi);
                }
            });
        }
        $scope.selectAll = function () {
            if ($scope.isSelectAll) {
                angular.forEach($scope.categories, function (category) {
                    category.isSelect = true;
                });
            }
            else {
                angular.forEach($scope.categories, function (category) {
                    category.isSelect = false;
                });
            }
        }

        $scope.go = function(category) {
            $scope.CategoryEdit = null;
            $.ajax({
                type: "POST",
                url: baseurl + "/GetCategoryDetail",
                dataType: "json",
                async: false,
                contentType: "application/json",
                data: JSON.stringify({ 'Id' : category.Id }),
                success: function (data) {
                    var Obj = data[0];
                    $scope.CategoryEdit = Obj;
                    $("#myModal").modal("show");
                },
                error: function (Error) {
                    console.log(Error);
                }
            });
            /* $scope.CategoryEdit = $http({
                 url: durl,
                 method: "POST",
                 data: { 'Id' : category.Id },
                 async:false
             }).then(function(response) {
                         console.log(response);
                         return response.data[0];
                     },
                     function(response) { // optional
                         // failed
                     });
             alert($scope.CategoryEdit.Adi);*/
        };
    });
</script>
</body>
</html>