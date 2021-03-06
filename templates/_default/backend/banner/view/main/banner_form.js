/**
 * Shopware 4.0
 * Copyright © 2012 shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 *
 * @category   Shopware
 * @package    Banner
 * @subpackage Main
 * @copyright  Copyright (c) 2012, shopware AG (http://www.shopware.de)
 * @version    $Id$
 * @author shopware AG
 */

/*{namespace name=backend/banner/view/main}*/

/**
 * Shopware UI - Banner View Main Form
 *
 * View component which features a form panel to edit
 * a existing banner.
 */
//{block name="backend/banner/view/main/banner_form"}
Ext.define('Shopware.apps.Banner.view.main.BannerForm', {
    extend : 'Enlight.app.Window',
    alias: 'widget.banner-view-main-banner-form',
    cls : 'addWindow',
    autoShow : true,
    border : 0,
    width : 700,
    height : 350,
    bodyPadding: 5,
    basePath: '{link file=""}/',

    /**
     * Initializes the component
     *
     * @return void
     */
    initComponent: function() {
        var me      = this;
        me.items    = me.createFormPanel();
        me.dockedItems = [{
            xtype: 'toolbar',
            ui: 'shopware-ui',
            dock: 'bottom',
            cls: 'shopware-toolbar',
            items: me.createActionButtons()
        }];


        me.callParent(arguments);
        // Load record
        me.formPanel.getForm().loadRecord(this.record);

    },

    /**
     * Creates the main form panel for this component.
     *
     * @return [object] generated Ext.form.Panel
     */
    createFormPanel: function() {
        var me = this,
            descField, linkField, validFrom, validUntil;

        // Description field
        descField = Ext.create('Ext.form.field.Text', {
            name        : 'description', //
            anchor      : '100%',
            allowBlank  : false,
            fieldLabel  : '{s name=form_add/description}Description{/s}',
            supportText : '{s name=form_add/description_support}Description of the banner e.g. Jackets-Winter-Special2013{/s}'
        });

        // Link field
        linkField = Ext.create('Ext.form.field.Text', {
            name        : 'link',
            anchor      : '100%',
            fieldLabel  : '{s name=form_add/link}Link{/s}',
            supportText : '{s name=form_add/link_support}Link which will be called up if the banner has been clicked.{/s}',
            emptyText   : 'http://'
        });

        var store = Ext.create('Ext.data.Store', {
            fields: ['id', 'value', 'display'],
            data: [
                { value: '_blank', display: '{s name=form_add/link_target/external}External{/s}' },
                { value: '_parent', display: '{s name=form_add/link_target/internal}Shopware{/s}' }
            ]
        });

        me.linkTarget = Ext.create('Ext.form.field.ComboBox', {
            name:'linkTarget',
            fieldLabel:'{s name=form_add/link_target/field}Link target{/s}',
            store: store,
            valueField:'value',
            displayField:'display',
            editable:false
        });


        // Get timing containers
        validFrom   = me.createValidFromContainer();
        validUntil  = me.createValidUntilContainer();
        
        // Media selection field
        var dropZone = Ext.create('Shopware.MediaManager.MediaSelection', {
            fieldLabel      : '{s name=form_add/banner}Banner{/s}',
            name            : 'media-manager-selection',
            supportText     : '{s name=form_add/banner_support}Banner image selection via the Media Manager. The selection is limited to one media.{/s}',
            helpText        : '{s name=form_add/banner_help}Banner image selection via the Media Manager. The selection is limited to one media.{/s}',
            multiSelect     : false,
            anchor          : '100%'
        });

        // Actual form panel
        me.formPanel = Ext.create('Ext.form.Panel', {
            border      : false,
            layout      : 'anchor',
            defaults: {
                labelStyle  : 'font-weight: 700; text-align: right;'
            },
            items       : [ descField, linkField, me.linkTarget, validFrom, validUntil, dropZone ]
        });

        return me.formPanel;
    },

    /**
     * Creates a container which includes the "valid from" field
     *
     * @return [object] generated Ext.container.Container
     */
    createValidFromContainer: function() {
        var me = this;

        me.validFromField = Ext.create('Ext.form.field.Date', {
                format      : 'd.m.Y',
                fieldLabel  : '{s name=form_add/from_label}Active from{/s}',
                name        : 'validFromDate',
                supportText : '{s name=form_add/from_support}Format: dd.mm.jjjj{/s}',
                columnWidth : .6,
                minValue    : new Date(),
                value       : new Date(),
                allowBlank  : true,
                listeners: {
                    change: function(field, newValue) {
                        me.validToField.setMinValue(newValue);
                    }
                }
            }
        );

        return Ext.create('Ext.container.Container', {
            layout      : 'column',
            anchor      : '100%',
            defaults: {
                labelStyle  : 'font-weight: 700; text-align: right;'
            },
            items   : [
                ,me.validFromField,
            {
                margin      : '0 0 0 10',
                format      : 'H:i',
                xtype       : 'timefield',
                name        : 'validFromTime',
                supportText : '{s name=form_add/from_time_support}Format: hh:mm{/s}',
                columnWidth : .4,
                minDate     : new Date()
            }]
        })
    },

    /**
     * Creates a container which includes the "valid until" field
     *
     * @return [object] generated Ext.container.Container
     */
    createValidUntilContainer: function() {
        var me = this;

        me.validToField = Ext.create('Ext.form.field.Date', {
            format      : 'd.m.Y',
            fieldLabel  : '{s name=form_add/to_date_label}Active till{/s}',
            name        : 'validToDate',
            supportText : '{s name=form_add/to_date_support}Format jjjj.mm.tt{/s}',
            columnWidth : .60,
            allowBlank  : true,
            listeners: {
                change: function(field, newValue) {
                    me.validFromField.setMaxValue(newValue);
                }
            }
        });

        return Ext.create('Ext.container.Container', {
            layout      : 'column',
            anchor      : '100%',
            defaults        : {
                labelStyle  : 'font-weight: 700; text-align: right;'
            },
            items       : [
                me.validToField,
            {
                margin      : '0 0 0 10',
                xtype       : 'timefield',
                name        : 'validToTime',
                format      : 'H:i',
                supportText : '{s name=form_add/to_time_support}Format: hh:mm{/s}',
                columnWidth : .40
            }]
        })
    },

    /**
     * Creates the action buttons for the component.
     *
     * @return [array] - Array of Ext.button.Button's
     */
    createActionButtons: function() {
        var me = this;

        return ['->', {
            text    : '{s name=form_add/cancel}Cancel{/s}',
            scope   : me,
            handler : me.destroy
        }, {
            text    : '{s name=form_add/save}Save{/s}',
            action  : 'saveBannerEdit',
            cls: 'primary'
        }];
    }
});
//{/block}
