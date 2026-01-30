<?php
/**
 * Layout Personalizado: BusinessCDT Light
 * * LOCALIZAÇÃO DO ARQUIVO:
 * Este arquivo deve ser salvo em:
 * /templates/business_cdt/html/com_content/article/tigrinho.php
 * * COMO USAR NO JOOMLA:
 * 1. Crie ou edite um Artigo.
 * 2. Vá na aba "Opções".
 * 3. No campo "Layout", selecione "Tigrinho".
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

// Atalhos para os dados do artigo
$item = $this->item;
$params = $item->params;
$images = json_decode($item->images);
$wa = Factory::getApplication()->getDocument()->getWebAssetManager();

// Imagem de Destaque
$heroImage = !empty($images->image_intro) ? htmlspecialchars($images->image_intro) : '';
?>

<!-- Container Principal (Força o tema Light para este artigo específico se desejado, ou usa o global) -->
<!-- Nota: As classes CSS utilizadas aqui dependem do arquivo css/template.css do template BusinessCDT -->
<article class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-12 gap-12" itemscope itemtype="https://schema.org/Article">
    
    <!-- HEADER LIMPO (Apenas Logo e Voltar) -->
    <div class="col-span-12 mb-8 flex justify-between items-center border-b border-gray-100 pb-4">
        <div class="flex items-center gap-2 text-xl font-black tracking-tighter text-slate-900 font-brand">
            <i class="fa-solid fa-shield-halved text-blue-600"></i>
            BUSINESS<span class="text-blue-600">CDT</span>
        </div>
        <a href="index.html" class="text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:text-blue-600 transition-colors">
            <i class="fa-solid fa-arrow-left mr-1"></i> Voltar ao Início
        </a>
    </div>

    <!-- Coluna Esquerda: Conteúdo -->
    <div class="col-span-12 lg:col-span-8">
        
        <!-- Header do Artigo -->
        <header class="mb-10 pb-8 border-b border-gray-200">
            <div class="flex items-center gap-3 text-[10px] font-bold text-blue-600 uppercase tracking-[0.2em] mb-4">
                <span class="bg-blue-100 px-2 py-1 rounded">
                    <?php echo $this->escape($item->category_title); ?>
                </span>
                <span class="text-gray-400">|</span>
                <span>Relatório</span>
            </div>
            
            <h1 class="text-3xl md:text-5xl font-black text-slate-900 leading-tight mb-6 font-brand uppercase" itemprop="headline">
                <?php echo $this->escape($item->title); ?>
            </h1>
            
            <div class="flex items-center gap-6 text-xs text-gray-500 font-medium">
                <span class="flex items-center gap-2">
                    <i class="far fa-calendar"></i> 
                    <?php echo HTMLHelper::_('date', $item->publish_up, Text::_('DATE_FORMAT_LC3')); ?>
                </span>
                <?php if ($item->author) : ?>
                <span class="flex items-center gap-2">
                    <i class="far fa-user"></i> <?php echo $item->author; ?>
                </span>
                <?php endif; ?>
            </div>
        </header>

        <!-- Imagem Hero (Se existir) -->
        <?php if ($heroImage) : ?>
        <div class="mb-10 rounded-lg overflow-hidden shadow-sm border border-gray-100">
            <img src="<?php echo $heroImage; ?>" alt="<?php echo $this->escape($item->title); ?>" class="w-full h-auto object-cover">
        </div>
        <?php endif; ?>

        <!-- Texto Principal -->
        <div class="text-slate-700 text-lg space-y-8 leading-relaxed" itemprop="articleBody">
            <!-- Introdução (Lead) -->
            <?php if ($item->introtext) : ?>
            <div class="text-xl text-slate-600 font-medium border-l-4 border-blue-600 pl-6 italic mb-8">
                <?php echo $item->introtext; ?>
            </div>
            <?php endif; ?>

            <!-- Texto Completo -->
            <?php echo $item->fulltext; ?>
        </div>

        <!-- Bloco de Autor/Conclusão -->
        <div class="mt-16 pt-8 border-t border-gray-200 bg-slate-50 p-8 rounded-lg flex items-center gap-6">
            <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center text-blue-600 font-bold text-xl font-brand border border-gray-200 shadow-sm">
                <?php echo substr($item->author, 0, 1); ?>
            </div>
            <div>
                <p class="text-slate-900 font-bold text-sm uppercase tracking-wider">Coach Nimul</p>
                <p class="text-xs text-gray-500">Analista de Risco & Segurança Digital.</p>
            </div>
        </div>

    </div>

    <!-- Sidebar Direita -->
    <aside class="col-span-12 lg:col-span-4 space-y-8">
        
        <!-- Widget: Produto Sticky (Ex: Cadeira) -->
        <div class="card-light p-6 sticky top-24 rounded-lg bg-white border border-gray-200 shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <span class="text-blue-600 text-[9px] font-black uppercase tracking-[0.2em]">Conforto Operacional</span>
                <span class="bg-gray-100 text-gray-600 text-[8px] px-2 py-1 rounded font-bold border border-gray-200">TOP PICK</span>
            </div>
            <div class="aspect-square bg-slate-50 rounded mb-4 flex items-center justify-center border border-gray-100 group overflow-hidden">
                    <i class="fas fa-chair text-6xl text-slate-300 group-hover:text-blue-600 transition duration-500 group-hover:scale-110"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-900 font-brand mb-2">Cadeira ThunderX3</h3>
            <p class="text-xs text-gray-500 mb-6 leading-relaxed">Proteja sua lombar durante a análise.</p>
            <a href="SEU_LINK_AMAZON_CADEIRA" target="_blank" class="block w-full btn-primary text-center font-black py-3 text-[10px] uppercase rounded shadow-lg bg-blue-600 text-white hover:bg-blue-700 transition">Ver Oferta</a>
        </div>

    </aside>

</article>
```
```eof