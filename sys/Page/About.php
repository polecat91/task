<div class="container">
    <div class="row">
        <div class="col-xs-12 text-center setup-content">
            <button class="btn btn-success add-new-task">
                Új feladat
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
            </button>
            <button class="btn btn-<?=$_SESSION['isCompact'] ? 'toolbar' : 'success'?> pull-right set-compact">
                <i class="fa fa-eye<?=$_SESSION['isCompact'] ? '-slash' : ''?>" aria-hidden="true"></i>
                Elvégzett feladatok
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-responsive table-striped table-hover">
                <thead>
                    <tr>
                        <th>Törlés</th>
                        <th>ID</th>
                        <th>Cím</th>
                        <th>Leírás</th>
                        <th>Elvégzett</th>
                        <th>Időpont</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($tblTask AS $rowTask) {
                        $strSuccess = ($rowTask['is_success'] != 0 ?
                                    '<span class="glyphicon glyphicon-ok" aria-hidden="true"><span style="color: transparent">1</span></span>':
                                    '<span class="glyphicon glyphicon-remove" aria-hidden="true"><span style="color: transparent">0</span></span>');
                        $strRemove = '<button class="btn btn-default remove-confirm" data-toggle="confirmation" data-popout="true" data-singleton="true"><i class="fa fa-times remove-row" aria-hidden="true"></i></button>';
                        print "
                            <tr>
                                <td>{$strRemove}</td>
                                <td>{$rowTask['id']}</td>
                                <td>{$rowTask['title']}</td>
                                <td>{$rowTask['description']}</td>
                                <td>{$strSuccess}</td>
                                <td>{$rowTask['create_date']}</td>
                            </tr>
                        ";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div
    class="modal fade task-item"
    tabindex="-1"
    role="dialog"
>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pull-left">Feladat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group" style="float: left;width: 100%;margin: 0;">
                        <label class="control-label col-xs-3 col-lg-2 text-right">Cím</label>
                        <div class="col-xs-9 col-lg-10">
                            <input type="text" name="title" required="required" maxlength="256" class="form-control">
                        </div>
                    </div>
                    <div class="form-group" style="float: left;width: 100%;margin: 0;">
                        <label class="control-label col-xs-3 col-lg-2 text-right">Leírás</label>
                        <div class="col-xs-9 col-lg-10">
                            <textarea name="description" required="required" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group" style="float: left;width: 100%;margin: 0;">
                        <label class="control-label col-xs-3 col-lg-2 text-right">Elvégzett</label>
                        <div class="col-xs-9 col-lg-10">
                            <label class="radio-content pull-left">
                                <input type="radio" name="success" required="required" class="form-control pull-left" value="0" checked>
                                <span class="success-label pull-left">Nem</span>
                            </label>
                            <label class="radio-content pull-left">
                            <input type="radio" name="success" required="required" class="form-control pull-left" value="1">
                            <span class="success-label pull-left">Igen</span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-toolbar" data-dismiss="modal">Mégse</button>
                <button type="button" class="btn btn-success">Mentés</button>
            </div>
        </div>
    </div>
</div>