/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class QueryUseridRes extends Rpc.Data
/*    */ {
/*    */   public int result;
/*    */   public int userid;
/*    */   public int roleid;
/*    */   public int level;
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 21 */     os.marshal(this.result);
/* 22 */     os.marshal(this.userid);
/* 23 */     os.marshal(this.roleid);
/* 24 */     os.marshal(this.level);
/* 25 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 30 */     this.result = os.unmarshal_int();
/* 31 */     this.userid = os.unmarshal_int();
/* 32 */     this.roleid = os.unmarshal_int();
/* 33 */     this.level = os.unmarshal_int();
/* 34 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 41 */       return (QueryUseridRes)super.clone();
/*    */     }
/*    */     catch (Exception e) {
/*    */     }
/* 45 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.QueryUseridRes
 * JD-Core Version:    0.6.2
 */