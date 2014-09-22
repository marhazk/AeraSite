/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class DBCreateRoleArg extends Rpc.Data
/*    */ {
/*    */   public int userid;
/*    */   public int logicuid;
/*    */   public int roleid;
/*    */   public RoleInfo roleinfo;
/*    */   public int au_suggest_referrer;
/*    */   public int player_suggest_referrer;
/*    */ 
/*    */   public DBCreateRoleArg()
/*    */   {
/* 19 */     this.roleinfo = new RoleInfo();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 24 */     os.marshal(this.userid);
/* 25 */     os.marshal(this.logicuid);
/* 26 */     os.marshal(this.roleid);
/* 27 */     os.marshal(this.roleinfo);
/* 28 */     os.marshal(this.au_suggest_referrer);
/* 29 */     os.marshal(this.player_suggest_referrer);
/* 30 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 35 */     this.userid = os.unmarshal_int();
/* 36 */     this.logicuid = os.unmarshal_int();
/* 37 */     this.roleid = os.unmarshal_int();
/* 38 */     os.unmarshal(this.roleinfo);
/* 39 */     this.au_suggest_referrer = os.unmarshal_int();
/* 40 */     this.player_suggest_referrer = os.unmarshal_int();
/* 41 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 48 */       DBCreateRoleArg o = (DBCreateRoleArg)super.clone();
/* 49 */       o.roleinfo = ((RoleInfo)this.roleinfo.clone());
/* 50 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 53 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.DBCreateRoleArg
 * JD-Core Version:    0.6.2
 */