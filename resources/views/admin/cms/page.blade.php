@extends('layout.admin.main')

@section('addstyle')
    <link rel="stylesheet" href="/adm/plugins/cleditor/jquery.cleditor.css" media="screen">
@endsection

@section('content')
    <div id="main-header" class="page-header">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>Главная
                <span class="divider">&raquo;</span>
            </li>
            <li>
                <i class="icon-info-sign"></i>CMS
                <span class="divider">&raquo;</span>
            </li>
            <li>
                <a href="{{ $url }}">{{ $page_title }}</a>
            </li>
        </ul>

        <h1 id="main-heading">
            {{ $page_title }}
        </h1>
    </div>

    <div id="main-content">
        <div class="row-fluid">
            <div class="span12 widget">
                <div class="widget-header">
                    <span class="title"><i class="icon-edit"></i> Редактировать страницу "{{ $page_title }}"</span>
                </div>
                <div class="widget-content form-container">
                    <form method="post" action="{{ $url }}" class="form-vertical">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="control-group">
                            <label class="control-label">Текст:</label>
                            <div class="controls">
                                <textarea id="cleditor" name="body">{!! base64_decode($body) !!}</textarea>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addscript')
    <script src="/adm/plugins/cleditor/jquery.cleditor.min.js"></script>
    <script src="/adm/plugins/cleditor/jquery.cleditor.icon.min.js"></script>
    <script src="/adm/plugins/cleditor/jquery.cleditor.table.min.js"></script>
    <script src="/adm/plugins/cleditor/jquery.cleditor.xhtml.min.js"></script>
    <script src="/adm/js/cms/page.js"></script>
@endsection