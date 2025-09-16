Retorno de um arquivo OFX parseado:
***Obs.: tem que tratar algumas coisas no ofx do NUBank ****
` 
$ofxContent = preg_replace('/\[0:(\w+)\]/', '[+0:$1]', $ofxContent);
$ofxContent = preg_replace('/\\[([-+]\\d+):BRT\\]/', '[$1:UTC]', $ofxContent); 
`

<pre class="sf-dump" id="sf-dump-1204404597" data-indent-pad="  " tabindex="0"><div class="sf-dump-search-wrapper sf-dump-search-hidden"> <input type="text" class="sf-dump-search-input"> <span class="sf-dump-search-count">0 of 0</span> <button type="button" class="sf-dump-search-input-previous" tabindex="-1"> <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1683 1331l-166 165q-19 19-45 19t-45-19L896 965l-531 531q-19 19-45 19t-45-19l-166-165q-19-19-19-45.5t19-45.5l742-741q19-19 45-19t45 19l742 741q19 19 19 45.5t-19 45.5z"></path></svg> </button> <button type="button" class="sf-dump-search-input-next" tabindex="-1"> <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1683 808l-742 741q-19 19-45 19t-45-19L109 808q-19-19-19-45.5t19-45.5l166-165q19-19 45-19t45 19l531 531 531-531q19-19 45-19t45 19l166 165q19 19 19 45.5t-19 45.5z"></path></svg> </button> </div><span class="sf-dump-note" style="cursor: pointer;">Endeken\OFX\OFXData</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1331 <span>▼</span></a><samp data-depth="1" class="sf-dump-expanded"><span style="color: #A0A0A0;"> // app/Livewire/Forms/ImportsForm.php:52</span>
  +<span class="sf-dump-public" title="Public property">signOn</span>: <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\SignOn
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail" style="cursor: pointer;">SignOn</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#875 <span>▶</span></a><samp data-depth="2" class="sf-dump-compact">
    +<span class="sf-dump-public" title="Public property">status</span>: <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Status
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Status</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1576 <span>▶</span></a><samp data-depth="3" class="sf-dump-compact">
      +<span class="sf-dump-public" title="Public property">code</span>: ""
      +<span class="sf-dump-public" title="Public property">severity</span>: ""
      +<span class="sf-dump-public" title="Public property">message</span>: ""
    </samp>}
    +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1726940053</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1326 <span>▶</span></a><samp data-depth="3" class="sf-dump-compact">
      <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Saturday, September 21, 2024
- 11m 24d 01:58:11.806619 from now">2024-09-21 17:34:13.0 +00:00</span>
    </samp>}
    +<span class="sf-dump-public" title="Public property">language</span>: "<span class="sf-dump-str" title="3 characters">POR</span>"
    +<span class="sf-dump-public" title="Public property">institute</span>: <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Institute
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Institute</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1663 <span>▶</span></a><samp data-depth="3" class="sf-dump-compact">
      +<span class="sf-dump-public" title="Public property">id</span>: "<span class="sf-dump-str" title="3 characters">260</span>"
      +<span class="sf-dump-public" title="Public property">name</span>: "<span class="sf-dump-str" title="18 characters">NU PAGAMENTOS S.A.</span>"
    </samp>}
  </samp>}
  +<span class="sf-dump-public" title="Public property">accountInfo</span>: <span class="sf-dump-const">null</span>
  +<span class="sf-dump-public" title="Public property">bankAccounts</span>: <span class="sf-dump-note" style="cursor: pointer;">array:1</span> [<a class="sf-dump-ref sf-dump-toggle" title="[Ctrl+click] Expand all children"><span>▼</span></a><samp data-depth="2" class="sf-dump-expanded">
    <span class="sf-dump-index">0</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\BankAccount
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note" style="cursor: pointer;">\</span><span class="sf-dump-ellipsis-tail" style="cursor: pointer;">BankAccount</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#672 <span>▼</span></a><samp data-depth="3" class="sf-dump-expanded">
      +<span class="sf-dump-public" title="Public property">accountNumber</span>: "<span class="sf-dump-str" title="9 characters">6354565-8</span>"
      +<span class="sf-dump-public" title="Public property">accountType</span>: "<span class="sf-dump-str" title="8 characters">CHECKING</span>"
      +<span class="sf-dump-public" title="Public property">balance</span>: "<span class="sf-dump-str" title="7 characters">6347.39</span>"
      +<span class="sf-dump-public" title="Public property">balanceDate</span>: <span class="sf-dump-note" style="cursor: pointer;">DateTime @1706670000</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1021 <span>▼</span></a><samp data-depth="4" class="sf-dump-expanded">
        <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Wednesday, January 31, 2024
- 1y 7m 15d 16:32:24.81206 from now
DST Off">2024-01-31 03:00:00.0 UTC (+00:00)</span>
      </samp>}
      +<span class="sf-dump-public" title="Public property">routingNumber</span>: "<span class="sf-dump-str" title="4 characters">0260</span>"
      +<span class="sf-dump-public" title="Public property">statement</span>: <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Statement
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail" style="cursor: pointer;">Statement</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#703 <span>▼</span></a><samp data-depth="4" class="sf-dump-expanded">
        +<span class="sf-dump-public" title="Public property">currency</span>: "<span class="sf-dump-str" title="3 characters">BRL</span>"
        +<span class="sf-dump-public" title="Public property">transactions</span>: <span class="sf-dump-note" style="cursor: pointer;">array:34</span> [<a class="sf-dump-ref sf-dump-toggle" title="[Ctrl+click] Expand all children"><span>▼</span></a><samp data-depth="5" class="sf-dump-expanded">
          <span class="sf-dump-index">0</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail" style="cursor: pointer;">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#647 <span>▼</span></a><samp data-depth="6" class="sf-dump-expanded">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="6 characters">CREDIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1704164400</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1355 <span>▼</span></a><samp data-depth="7" class="sf-dump-expanded">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Tuesday, January 2, 2024
- 1y 8m 13d 16:32:24.812371 from now
DST Off">2024-01-02 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">500.0</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">65941911-e836-4114-b85f-68fd5e2f69ee</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="135 characters">TransferÃªncia recebida pelo Pix - JOSE ROSSIGALLI - â€¢â€¢â€¢.149.688-â€¢â€¢ - BCO DO BRASIL S.A. (0001) AgÃªncia: 666 Conta: 111706-8</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">1</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#826 <span>▼</span></a><samp data-depth="6" class="sf-dump-expanded">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1704164400</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#496 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Tuesday, January 2, 2024
- 1y 8m 13d 16:32:24.812395 from now
DST Off">2024-01-02 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-500.0</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">65941eb2-af6b-4a1e-9323-3a6018860b5a</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="70 characters">Pagamento de boleto efetuado - INSTITUTO DE ODONTOLOGIA DO BRASIL LTDA</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">2</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1316 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1704164400</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1027 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Tuesday, January 2, 2024
- 1y 8m 13d 16:32:24.812416 from now
DST Off">2024-01-02 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-19.0</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">6594a858-c162-4283-8a25-24fcdfb0cf32</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="41 characters">Compra no dÃ©bito - Pag*Autopostobelajoia</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">3</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1556 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1704250800</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#557 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Wednesday, January 3, 2024
- 1y 8m 12d 16:32:24.812436 from now
DST Off">2024-01-03 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-25.98</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">65957807-e808-4585-bf97-0c4bd5490d4c</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="39 characters">Compra no dÃ©bito - Mocam Supermercados</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">4</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#800 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1704337200</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#611 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Thursday, January 4, 2024
- 1y 8m 11d 16:32:24.812455 from now
DST Off">2024-01-04 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-15.5</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">6596b399-657e-4322-83ba-55fc60c48b38</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="39 characters">Compra no dÃ©bito - Rebellatto e Moreno</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">5</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#537 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1704423600</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#532 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Friday, January 5, 2024
- 1y 8m 10d 16:32:24.812473 from now
DST Off">2024-01-05 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-20.55</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">65982874-6a46-48c3-867a-ab0908a2635a</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="35 characters">Compra no dÃ©bito - Bistek Superm F</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">6</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1479 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1704682800</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1611 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Monday, January 8, 2024
- 1y 8m 7d 16:32:24.812493 from now
DST Off">2024-01-08 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-4.46</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">659c1498-3b29-4c08-98f4-df4eb08707b4</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="35 characters">Compra no dÃ©bito - Bistek Superm F</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">7</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1215 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1704682800</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1692 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Monday, January 8, 2024
- 1y 8m 7d 16:32:24.812512 from now
DST Off">2024-01-08 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-60.0</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">659c8c26-c518-439d-8e28-39f165f86fe2</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="28 characters">Compra no dÃ©bito - Posto Jc</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">8</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#783 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1704682800</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1182 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Monday, January 8, 2024
- 1y 8m 7d 16:32:24.812547 from now
DST Off">2024-01-08 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-1000.0</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">659ca6a9-f363-49a2-af44-9c87c2aedd3f</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="142 characters">TransferÃªncia enviada pelo Pix - Gian Mateus da Silveira - â€¢â€¢â€¢.767.389-â€¢â€¢ - NU PAGAMENTOS - IP (0260) AgÃªncia: 1 Conta: 41771192-6</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">9</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1496 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1704769200</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#773 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Tuesday, January 9, 2024
- 1y 8m 6d 16:32:24.81257 from now
DST Off">2024-01-09 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-68.14</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">659ca6ce-01ad-4c65-b145-7ef085d97982</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="57 characters">Pagamento de boleto efetuado - MAPFRE SEGUROS GERAIS S.A.</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">10</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#953 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1704769200</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1245 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Tuesday, January 9, 2024
- 1y 8m 6d 16:32:24.81259 from now
DST Off">2024-01-09 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-21.84</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">659ca6fb-5692-4430-b546-6ebfce7dc902</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="53 characters">Pagamento de boleto efetuado - CELESC DISTRIBUICAO SA</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">11</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#486 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1704769200</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1078 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Tuesday, January 9, 2024
- 1y 8m 6d 16:32:24.812609 from now
DST Off">2024-01-09 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-66.77</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">659ca70d-c003-491d-8882-336328d36346</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="71 characters">Pagamento de boleto efetuado - CEA PAY FUNDO DE INVESTIMENTO EM DIREITO</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">12</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1225 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1704769200</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1586 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Tuesday, January 9, 2024
- 1y 8m 6d 16:32:24.812628 from now
DST Off">2024-01-09 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-4.05</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">659d67a4-0096-42b9-b71e-f7666e2d5658</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="35 characters">Compra no dÃ©bito - Bistek Superm F</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">13</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#899 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="6 characters">CREDIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1704769200</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#948 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Tuesday, January 9, 2024
- 1y 8m 6d 16:32:24.812646 from now
DST Off">2024-01-09 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">5414.9</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">659d9d0d-ab65-4e0c-9b6e-f6d8ad3e4712</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="142 characters">TransferÃªncia recebida pelo Pix - INSTITUTO DE ODONTOLOGIA DO BRASIL LTDA - 33.136.032/0001-78 - COOP VIACREDI AgÃªncia: 101 Conta: 1228320-7</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">14</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1419 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1704769200</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#797 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Tuesday, January 9, 2024
- 1y 8m 6d 16:32:24.812665 from now
DST Off">2024-01-09 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-39.99</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">659dcae9-ce1e-42a4-829b-e92f76529264</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="29 characters">Compra no dÃ©bito - Work Cell</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">15</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#991 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1704855600</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1049 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Wednesday, January 10, 2024
- 1y 8m 5d 16:32:24.812684 from now
DST Off">2024-01-10 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-19.97</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">659eb3a2-fda5-4c3b-b8f6-a317422090c0</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="35 characters">Compra no dÃ©bito - Bistek Superm F</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">16</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1502 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1704855600</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1390 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Wednesday, January 10, 2024
- 1y 8m 5d 16:32:24.812701 from now
DST Off">2024-01-10 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-1275.77</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">659ec58c-2936-433c-99ba-01f2fc47096c</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="53 characters">Pagamento de boleto efetuado - TERRENA ADMINISTRADORA</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">17</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1703 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1704855600</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#936 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Wednesday, January 10, 2024
- 1y 8m 5d 16:32:24.812716 from now
DST Off">2024-01-10 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-178.2</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">659ec59d-b9e3-4de0-a09b-3d6571c727e3</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="60 characters">Pagamento de boleto efetuado - PORTOSEG SA C FINANC E INVEST</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">18</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#827 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1704855600</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1425 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Wednesday, January 10, 2024
- 1y 8m 5d 16:32:24.812731 from now
DST Off">2024-01-10 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-307.55</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">659ec5ac-7478-4c1d-845b-2f146662eb91</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="49 characters">Pagamento de boleto efetuado - RES SANTA EFIGENIA</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">19</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1271 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1704855600</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1200 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Wednesday, January 10, 2024
- 1y 8m 5d 16:32:24.812748 from now
DST Off">2024-01-10 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-1540.64</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">659ec5cb-d20d-4cb7-8432-e7e3159cfd2d</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="19 characters">Pagamento de fatura</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">20</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1184 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1704855600</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1150 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Wednesday, January 10, 2024
- 1y 8m 5d 16:32:24.812768 from now
DST Off">2024-01-10 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-461.47</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">659ec629-5c37-4689-a035-90364a449a10</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="19 characters">Pagamento de fatura</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">21</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1366 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1704855600</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#680 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Wednesday, January 10, 2024
- 1y 8m 5d 16:32:24.812788 from now
DST Off">2024-01-10 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-17.47</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">659f1b03-1897-45a3-b472-7aa2c1fb3fd9</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="35 characters">Compra no dÃ©bito - Bistek Superm F</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">22</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#700 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1704942000</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1107 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Thursday, January 11, 2024
- 1y 8m 4d 16:32:24.812807 from now
DST Off">2024-01-11 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-170.0</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">659fe39b-ba26-4505-9d42-69714d4216a1</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="41 characters">Pagamento de boleto efetuado - VIVO SC PR</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">23</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1030 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1705028400</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#998 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Friday, January 12, 2024
- 1y 8m 3d 16:32:24.812825 from now
DST Off">2024-01-12 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-28.95</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">65a1643f-d71b-4f72-b0b2-58c68d3a4d95</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="35 characters">Compra no dÃ©bito - Bistek Superm F</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">24</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#543 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1705028400</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#927 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Friday, January 12, 2024
- 1y 8m 3d 16:32:24.812844 from now
DST Off">2024-01-12 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-70.0</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">65a1d40a-a42c-46c5-93cd-c83bf53895c1</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="28 characters">Compra no dÃ©bito - Posto Jc</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">25</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1159 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1705114800</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#676 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Saturday, January 13, 2024
- 1y 8m 2d 16:32:24.812863 from now
DST Off">2024-01-13 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-8.29</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">65a2f4b6-7025-4b47-993e-2725bb0e05ee</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="35 characters">Compra no dÃ©bito - Bistek Superm F</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">26</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1626 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1705114800</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1701 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Saturday, January 13, 2024
- 1y 8m 2d 16:32:24.812881 from now
DST Off">2024-01-13 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-65.0</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">65a2fbc8-c277-49fc-9b81-4a78d9352a33</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="41 characters">Compra no dÃ©bito - Rei das Sombrancelhas</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">27</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1100 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1705114800</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1691 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Saturday, January 13, 2024
- 1y 8m 2d 16:32:24.8129 from now
DST Off">2024-01-13 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-9.99</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">65a2fcab-8b9c-49b6-b4f8-de7587db844e</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="35 characters">Compra no dÃ©bito - Bistek Superm F</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">28</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1545 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1705546800</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#633 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Thursday, January 18, 2024
- 1y 7m 28d 16:32:24.812918 from now
DST Off">2024-01-18 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-450.0</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">65a91e14-3e85-49fc-818e-4bde8423ae4d</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="141 characters">TransferÃªncia enviada pelo Pix - Ã‰dnei Aparecida Silva - â€¢â€¢â€¢.389.388-â€¢â€¢ - NU PAGAMENTOS - IP (0260) AgÃªncia: 1 Conta: 41550904-4</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">29</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1497 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1705546800</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#784 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Thursday, January 18, 2024
- 1y 7m 28d 16:32:24.813076 from now
DST Off">2024-01-18 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-1020.99</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">65a91e64-e2f1-4b00-aa53-58d0488221e3</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="60 characters">Pagamento de boleto efetuado - IUGU SERVICOS NA INTERNET S.A</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">30</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1269 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1705546800</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1510 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Thursday, January 18, 2024
- 1y 7m 28d 16:32:24.813151 from now
DST Off">2024-01-18 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-345.57</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">65a99d0d-d5d2-4138-b3dc-164118bebadd</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="19 characters">Pagamento de fatura</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">31</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#603 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1705546800</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1338 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Thursday, January 18, 2024
- 1y 7m 28d 16:32:24.813179 from now
DST Off">2024-01-18 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-26.86</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">65a9a355-534c-4c75-a5f0-bb2bc89f51cf</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="35 characters">Compra no dÃ©bito - Bistek Superm F</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">32</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#816 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="5 characters">DEBIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1706238000</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#685 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Friday, January 26, 2024
- 1y 7m 20d 16:32:24.813203 from now
DST Off">2024-01-26 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">-13.87</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">65b3d0fb-5230-47b2-89c6-867ac1239b00</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="35 characters">Compra no dÃ©bito - Bistek Superm F</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
          <span class="sf-dump-index">33</span> =&gt; <span class="sf-dump-note sf-dump-ellipsization" title="Endeken\OFX\Transaction
"><span class="sf-dump-ellipsis sf-dump-ellipsis-note">Endeken\OFX</span><span class="sf-dump-ellipsis sf-dump-ellipsis-note">\</span><span class="sf-dump-ellipsis-tail">Transaction</span></span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1063 <span>▶</span></a><samp data-depth="6" class="sf-dump-compact">
            +<span class="sf-dump-public" title="Public property">type</span>: "<span class="sf-dump-str" title="6 characters">CREDIT</span>"
            +<span class="sf-dump-public" title="Public property">date</span>: <span class="sf-dump-note">DateTime @1706238000</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#922 <span>▶</span></a><samp data-depth="7" class="sf-dump-compact">
              <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Friday, January 26, 2024
- 1y 7m 20d 16:32:24.813223 from now
DST Off">2024-01-26 03:00:00.0 UTC (+00:00)</span>
            </samp>}
            +<span class="sf-dump-public" title="Public property">userInitiatedDate</span>: <span class="sf-dump-const">null</span>
            +<span class="sf-dump-public" title="Public property">amount</span>: <span class="sf-dump-num">5.0</span>
            +<span class="sf-dump-public" title="Public property">uniqueId</span>: "<span class="sf-dump-str" title="36 characters">65b3d725-730c-4aa2-8167-49b838bfdf45</span>"
            +<span class="sf-dump-public" title="Public property">name</span>: ""
            +<span class="sf-dump-public" title="Public property">memo</span>: "<span class="sf-dump-str" title="126 characters">TransferÃªncia recebida pelo Pix - ANA PAULA LAMIN - â€¢â€¢â€¢.721.549-â€¢â€¢ - BCO C6 S.A. (0336) AgÃªncia: 1 Conta: 469656-5</span>"
            +<span class="sf-dump-public" title="Public property">sic</span>: ""
            +<span class="sf-dump-public" title="Public property">checkNumber</span>: ""
          </samp>}
        </samp>]
        +<span class="sf-dump-public" title="Public property">startDate</span>: <span class="sf-dump-note">DateTime @1704078000</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1321 <span>▶</span></a><samp data-depth="5" class="sf-dump-compact">
          <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Monday, January 1, 2024
- 1y 8m 14d 16:32:24.812165 from now
DST Off">2024-01-01 03:00:00.0 UTC (+00:00)</span>
        </samp>}
        +<span class="sf-dump-public" title="Public property">endDate</span>: <span class="sf-dump-note">DateTime @1706670000</span> {<a class="sf-dump-ref sf-dump-toggle" target="_top" title="[Ctrl+click] Expand all children">#1625 <span>▶</span></a><samp data-depth="5" class="sf-dump-compact">
          <span class="sf-dump-meta">date</span>: <span class="sf-dump-const" title="Wednesday, January 31, 2024
- 1y 7m 15d 16:32:24.812189 from now
DST Off">2024-01-31 03:00:00.0 UTC (+00:00)</span>
        </samp>}
      </samp>}
      +<span class="sf-dump-public" title="Public property">transactionUid</span>: "<span class="sf-dump-str">1</span>"
      +<span class="sf-dump-public" title="Public property">agencyNumber</span>: "<span class="sf-dump-str">1</span>"
    </samp>}
  </samp>]
</samp>}
</pre>