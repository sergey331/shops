<?php

namespace Kernel\Model;

class Paginator
{
    protected array $response = [];

    /**
     * @param array $response
     */
    public function setResponse(array $response): void
    {
        $this->response = $response;
    }

    /**
     * @return array
     */
    public function getResponse(): array
    {
        $this->getLinks();
        return $this->response;
    }

    public function appends(array|string $key, $value = null)
    {
        if (is_array($key)) {
            $this->response = array_merge($this->response,$key);
        } else {
            $this->response[$key] = $value;
        }
    }

    public static function html($data): string
    {
        $html = '<nav class="pt-12" aria-label="Page navigation">';
        $html .= '<ul class="d-flex justify-content-center align-items-center gap-4 list-unstyled">';

        // Previous button
        if ($data->has_prev) {
            $html .= '<li>';
            $html .= '<a href="' . htmlspecialchars($data->prevLink) . '" class="text-gray-700 hover:text-primary px-3 py-1 text-decoration-none">Prev</a>';
            $html .= '</li>';
        } else {
            $html .= '<li class="opacity-50 cursor-not-allowed"><span class="px-3 py-1 text-gray-400">Prev</span></li>';
        }

        // Page links
        foreach ($data->links as $key => $link) {
            $i = $key + 1;
            $activeClass = ($i == $data->current_page)
                ? 'bg-primary text-white'
                : 'bg-banner text-black';

            $html .= '<li>';
            $html .= '<a href="' . htmlspecialchars($link) . '" class="' . $activeClass . ' px-3 py-1 rounded text-decoration-none">' . $i . '</a>';
            $html .= '</li>';
        }

        // Next button
        if ($data->has_next) {
            $html .= '<li>';
            $html .= '<a href="' . htmlspecialchars($data->nextLink) . '" class="text-gray-700 hover:text-primary px-3 py-1 text-decoration-none">Next</a>';
            $html .= '</li>';
        } else {
            $html .= '<li class="opacity-50 cursor-not-allowed"><span class="px-3 py-1 text-gray-400">Next</span></li>';
        }

        $html .= '</ul></nav>';

        return $html;
    }

    private function getLinks(): void
    {
        $totalPages = (int)$this->response['total_pages'];
        $current = (int)$this->response['current_page'];
        $baseParams = array_diff_key(
            $this->response,
            array_flip([
                'total_pages', 'has_next', 'has_prev', 'nextLink', 'prevLink',
                'data', 'total', 'links', 'total_data', 'current_page'
            ])
        );

        $links = [];
        for ($i = 1; $i <= $totalPages; $i++) {
            $links[] = $this->buildLink($i, $baseParams);
        }

        $this->response['links'] = $links;
        $this->response['nextLink'] = $this->response['has_next']
            ? $this->buildLink($current + 1, $baseParams)
            : null;

        $this->response['prevLink'] = $this->response['has_prev']
            ? $this->buildLink($current - 1, $baseParams)
            : null;
    }

    private function buildLink(int $page, array $baseParams): string
    {
        // Always include page param
        $params = array_merge($baseParams, ['page' => $page]);
        return '?' . http_build_query($params);
    }


}