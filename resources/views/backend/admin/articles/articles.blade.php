@extends('backend.admin.layout.master')
@section('title') Articles @endsection
@section('content')
<div class="card">
    <div class="card-body p-3">
        <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <h5>Articles</h5>
            <div class="d-flex align-items-center flex-wrap row-gap-3">
                <!-- Filtre par statut -->
                <div class="dropdown me-3">
                    <a href="javascript:void(0);" class="dropdown-toggle btn btn-white d-inline-flex align-items-center" data-bs-toggle="dropdown">
                        Sélectionner le statut
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-3" id="status-dropdown">
                        <li>
                            <a href="{{ route('admin.articles', ['status' => 'all']) }}" class="dropdown-item rounded-1">Tous les articles</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.articles', ['status' => 'active']) }}" class="dropdown-item rounded-1">Articles Publiés</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.articles', ['status' => 'inactive']) }}" class="dropdown-item rounded-1">Articles Non Publiés</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.articles', ['status' => 'pending']) }}" class="dropdown-item rounded-1">Articles En Attente</a>
                        </li>
                    </ul>
                </div>

                <!-- Filtre par période -->
                <div class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle btn btn-white d-inline-flex align-items-center" data-bs-toggle="dropdown">
                        Trier par : Derniers 7 jours
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-3" id="period-dropdown">
                        <li>
                            <a href="{{ route('admin.articles', ['period' => 'recently_added']) }}" class="dropdown-item rounded-1">Récemment ajoutés</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.articles', ['period' => 'last_month']) }}" class="dropdown-item rounded-1">Dernier mois</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.articles', ['period' => 'last_7_days']) }}" class="dropdown-item rounded-1">Derniers 7 jours</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    @if ($totalArticles > 0)
    @foreach ($articles as $article)
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="border-bottom mb-3">
                        <div class="row mb-3">
                            <div class="col-md-10">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-xxl rounded me-3">
                                        <img src="{{ asset('assets/images/article.png') }}" class="rounded" alt="Img">
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center mb-2">
                                            <p class="me-2 mb-0 fs-12">
                                                <i class="ti ti-calendar me-1"></i>
                                                {{ \Carbon\Carbon::parse($article->created_at)->locale('fr')->isoFormat('D MMM YYYY') }}
                                            </p>
                                            <span class="badge badge-soft-info ms-2">{{ $article->category->name }}</span>
                                            <!-- Vérifier si l'article est en attente -->

                                        </div>

                                        <p class="fw-medium text-dark mb-2">
                                            <a href="{{ route('blog.details', ['article' => $article]) }}">{{ $article->title }}</a>
                                        </p>
                                        @if ($article->status == 0)
                                            <div class="mb-2">
                                                <!-- Bouton Accepter -->
                                                <a href="javascript:void(0);" class="btn btn-sm btn-success me-2"
                                                onclick="showCommentModal('accepter', '{{ route('admin.article.accept', ['article' => $article]) }}')">
                                                    <i class="ti ti-check"></i> Accepter
                                                </a>

                                                <!-- Bouton Rejeter -->
                                                <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                                                onclick="showCommentModal('rejeter', '{{ route('admin.article.reject', ['article' => $article]) }}')">
                                                    <i class="ti ti-x"></i> Rejeter
                                                </a>
                                            </div>
                                        @endif
                                        <div class="d-flex align-items-center">
                                            <span class="avatar avatar-xs avatar-rounded me-2">
                                                <img src="{{ asset('assets/images/senior.png') }}" alt="Img">
                                            </span>
                                            <p class="text-gray mb-0">{{ $article->expert->lastname }} {{ $article->expert->firstname }}</p>
                                        </div>
                                    </div>

                                    {{-- <div>
                                        <div class="d-flex align-items-center mb-2">
                                            <p class="me-2 mb-0 fs-12">
                                                <i class="ti ti-calendar me-1"></i>
                                                {{ \Carbon\Carbon::parse($article->created_at)->locale('fr')->isoFormat('D MMM YYYY') }}
                                            </p>
                                            <span class="badge badge-soft-info ms-2">{{ $article->category->name }}</span>
                                        </div>
                                        <p class="fw-medium text-dark mb-2">
                                            <a href="{{ route('blog.details', ['article' => $article]) }}">{{ $article->title }}</a>
                                        </p>
                                        <div class="d-flex align-items-center">
                                            <span class="avatar avatar-xs avatar-rounded me-2">
                                                <img src="{{ asset('assets/images/senior.png') }}" alt="Img">
                                            </span>
                                            <p class="text-gray mb-0">{{ $article->expert->lastname }} {{ $article->expert->firstname }}</p>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-10">
                            @if ($article->status == 0)
                                <span class="text-info">Note:</span> {{ $article->note }}
                            @else
                                <div class="d-flex align-items-center">
                                    <div class="border-end pe-4">
                                        <h6>{{ $article->likes_count }}</h6>
                                        <p class="fs-12">J'aime</p>
                                    </div>
                                    {{-- <div class="border-end px-4">
                                        <h6>{{ $article->comments_count }}</h6>
                                        <p class="fs-8">Commentaires</p>
                                    </div> --}}
                                    <div class="border-end px-2 ps-4">
                                        <h6>{{ $article->reviews_count }}</h6>
                                        <p class="fs-12">Avis</p>
                                    </div>
                                    <div class="ps-4">
                                        <h6>{{ $article->views_count }}</h6>
                                        <p class="fs-12">Vues</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-2">
                            <div class="d-flex justify-content-end">
                                <span class="badge
                                    @if($article->status == \App\Models\Article::PENDING)
                                        badge-info
                                    @elseif($article->status == \App\Models\Article::PUBLISHED)
                                        badge-secondary
                                    @elseif($article->status == \App\Models\Article::REJECTED)
                                        badge-pink
                                    @endif
                                ">
                                    {{ $article->status_label }}  <!-- Accesseur pour afficher le label -->
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @else
    <div class="text-center p-4">
        <img src="{{ asset('assets/images/empty.png') }}" alt="Pas d'équipe" width="150">
        <p class="text-muted mt-3">Aucun article disponible.</p>
    </div>
    @endif
</div>

<!-- Modal pour confirmation avec note -->
<div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentModalLabel">Confirmer l'action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="confirmationMessage">Êtes-vous sûr de vouloir effectuer cette action ?</p>
                <form method="POST" class="comment-form">
                    @csrf
                    <textarea name="note" class="form-control" rows="2" placeholder="Ajouter une note pour l'auteur..."></textarea>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary m--1" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary m-1">Confirmer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function showCommentModal(action, route) {
        var modal = $('#commentModal');
        var message = action === 'accepter' ? "Êtes-vous sûr de vouloir accepter cet article ?" : "Êtes-vous sûr de vouloir rejeter cet article ?";
        modal.find('#confirmationMessage').text(message);
        modal.find('.comment-form').attr('action', route);
        modal.modal('show');
    }
</script>
@endsection


