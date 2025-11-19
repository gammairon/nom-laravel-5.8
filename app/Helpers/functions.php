<?php

if (! function_exists('selected')) {
    /**
     * echo attribute 'selected'
     *
     * @param  mixed  $default
     * @param  mixed   $current
     * @return string
     */
    function selected($default, $current): string
    {
        return $default == $current ? 'selected':'';
    }
}

if (! function_exists('selectedOld')) {
    /**
     * echo attribute 'selected'
     *
     * @param  mixed  $default
     * @param  mixed   $current
     * @return string
     */
    function selectedOld($key, $current = '', $default = ''): string
    {
        return old($key, $default) == $current ? 'selected':'';
    }
}

if (! function_exists('checked')) {
    /**
     * echo attribute 'checked'
     *
     * @param  mixed  $default
     * @param  mixed   $current
     * @return string
     */
    function checked($default, $current): string
    {
        return $default == $current ? 'checked':'';
    }
}

if (! function_exists('buildCheckboxTree')) {
    /**
     * Build html tree from nodes
     *
     * @param  array  $nodes
     * @return string
     */
    function buildCheckboxTree(iterable $nodes, $nodeName, $oldNodes = [], $depth = 0): string
    {


        $html = sprintf('<ul class="tree depth-%s">', $depth);


        foreach ($nodes as $key => $node) {
            $html .= sprintf('<li class="form-check item-tree %s"><input type="checkbox" class="form-check-input" name="'.$nodeName.'['.$node->id.']" value="'.$node->id.'" %s/><label>'.$node->name.'</label>', $key, in_array($node->id, $oldNodes) ? "checked":"");

            if($node->children->isNotEmpty()){
                $html .= buildCheckboxTree($node->children, $nodeName, $oldNodes, $depth+1);
            }

            $html .= '</li>';
        }

        $html .= '</ul>';
        return $html;
    }
}

if (! function_exists('doTransaction')) {

    /**
     * @param callable $func
     * @return null|mixed
     * @throws Exception
     */
    function doTransaction(callable $func, $default = null)
    {
        DB::beginTransaction();

        try {

            $result = call_user_func($func);

            DB::commit();

            return $result;

        } catch (\Exception $e) {
            DB::rollback();
            return $default;
        } catch (\Throwable $e) {
            DB::rollback();
            return $default;
        }
    }
}